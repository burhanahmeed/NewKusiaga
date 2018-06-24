Vue.use(window.vuelidate.default)
const {required} =  window.validators
const touchMap = new WeakMap()
const password = new Vue({
	el: '#app',
	data: {
		password: '',
		showError: false,
		showExp : false,
		showPasswordError: false
	},
	validations:{
		password: {
			required
		}
	},
	methods: {
		submitpassword: function() {
			this.$v.$touch()
			var self = this
			if (this.$v.$invalid) {
				this.showError = true
			} else {
				axios.post('url/password/'+short_url, {
					password: this.password
				}).then(function(res){
					console.log(res)
					if (res.data.success == false && res.data.data.success!=true) {
						self.showPasswordError = true	
					}
					if (res.data.data.expired) {
						self.showExp = true
					}
					if (res.data.success) {
						setTimeout(function() {
							window.location = ""+res.data.data.long_url+""
						}, 1000)
					}
				}).catch(function(err){
					console.log(err)
				})
				// console.log(short_url)
			}
		},
		closeDialog(){
			this.showError = false
			this.showPasswordError = false
		},
		onVisible(isVisible){
		    if (isVisible)
		        return
		    this.showError = false
		}
	}
})