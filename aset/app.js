// Vue.component('example', require('./components/Example.vue'));
// Vue.component('contact-form', require('./Contact-form.vue'));
'use strict'; 
// $(document).ready(function(){
// 	$('#newshrt').click(function(){
// 		$('#mainfrm').show();
// 		$('#inpt-cstm').val('');
// 		$('#inpt-date').val('');
// 		$('#inpt-pwd').val('');
// 		$('#url').val('');
// 		$('#hasil_short').hide();
// 	});
// });

// $(document).ready(function(){
// 	var status = false;
// 	$('#url').change(function(){
// 		if ($('#url').val().length < 4 || $('#url').val().length == 0) {
// 			$('#urlerr').text('Long URL is Invalid');
// 			status = false;
// 		} else {
// 			$('#urlerr').text('');
// 			status = true;
// 		}
// 	});
// 	$('#input-cstm').change(function(){
// 		if ($('#input-cstm').val().length < 5 && $('#input-cstm').val().length > 0) {
// 			$('#customerr').text('5 or More Character Please');
// 			status = false;
// 		} else {
// 			$('#customerr').text('');
// 			status = true;
// 		}
// 	});
// 	$('#input-pwd').change(function(){
// 		if ($('#input-pwd').val().length < 6 && $('#input-pwd').val().length > 0) {
// 			$('#passerr').text('Password cannot less than 6 characters');
// 			status = false;
// 		} else {
// 			$('#passerr').text('');
// 			status = true;
// 		}
// 	});

// 	$('#submit').click(function(){
		
// 	})
// });

$(document).ready(function(){

	$('._hamburger').click(function(){
		$('nav._navbar').toggleClass('nav_active');
	});	

});


Vue.component('date-picker', VueBootstrapDatetimePicker)
// Using font-awesome 5 icons
$.extend(true, $.fn.datetimepicker.defaults, {
  icons: {
    time: 'far fa-clock',
    date: 'far fa-calendar',
    up: 'fas fa-arrow-up',
    down: 'fas fa-arrow-down',
    previous: 'fas fa-chevron-left',
    next: 'fas fa-chevron-right',
    today: 'fas fa-calendar-check',
    clear: 'far fa-trash-alt',
    close: 'far fa-times-circle'
  }
})

Vue.use(window.vuelidate.default)
const {required, url, helpers, minLength} =  window.validators
const touchMap = new WeakMap()
const submitUrl = new Vue({
	el: '#app',

	data: {
		longurl: '',
		customurl: '',
		password: '',
		expiration: '',
		customstatus: false,
		submitStatus: false,
		submitStatus_err: false,
		show_result: false,
		resulturl: '',
		options: {
	      // https://momentjs.com/docs/#/displaying/
	      format: 'MM/DD/YYYY h:mm:ss A',
	      minDate: new Date(),
	      useCurrent: false,
	      showClear: true,
	      showClose: true,
	    }

	},
	validations: {
		longurl: {
			required, 
			url
		},
		customurl: {
			nospace: helpers.regex('nospace', /^[a-zA-Z0-9-_]+$/),
			minLength: minLength(5),
			isUnique(value){
				if (value==='') {return true}
				this.customstatus = true
				var self = this
				setTimeout(function() {
					self.customstatus = false
					// console.log('tesss')
				}, 800)
				return new Promise(function(resolve, reject){
					fetch('url/check/'+value, {
						method: 'GET',
						mode: 'cors',
						headers: {
					      'content-type': 'application/json',
					      "Accept": "application/json"
					    },
					})
					.then((response)=>{
						return response.json()
					})
					.then((resp)=>{
						// console.log(resp)
						if (resp.success) {
							resolve(resp)							
						} else {
							reject(resp)						
						}
					}).catch(function(err){
						// console.log(err)
						reject(err)
					})

				})
			}
		},
		password: {
			minLength: minLength(6)
		},
		resulturl:{},
		expiration: {}
	},
	methods:{
		submitUrl: function() {
			this.$v.$touch()
			this.submitStatus = true
			var self = this
			if (this.$v.$invalid) {
		        this.submitStatus = true
		        this.submitStatus_err = true
		      } else {
		      	axios.post('url/shorten', {
		      		longurl: this.longurl,
		      		customurl: this.customurl,
		      		password: this.password,
		      		expiration: this.expiration
		      	})
		      	.then(function(res){
		      		self.show_result = true
		      		self.submitStatus = false
		      		self.resulturl = 'https://kusia.ga/'+res.data.data.short_url
		      		// console.log(res.data)
		      	}).catch(function(err){
		      		console.log(err)
		      		self.submitStatus = false
		      	})
		      }
		},
		status: function(validation) {
			return {
				error: validation.$error,
				dirty: validation.$dirty
			}
		},
		delayTouch($v) {
	      $v.$reset()
	      if (touchMap.has($v)) {
	        clearTimeout(touchMap.get($v))
	      }
	      touchMap.set($v, setTimeout($v.$touch, 800))
	    },
	    chgSubmitStatus(){
	    	this.submitStatus_err= false
	    },
	    hideShowResult() {
	    	this.show_result = false
	    	this.longurl= ''
			this.customurl= ''
			this.password= ''
			this.expiration= ''
			this.resulturl= ''
	    }
	}
})