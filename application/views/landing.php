<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Get your business success and reach the peak by using our service link shortener KUSIAGA, an Indonesian link shortener. We're happy to help success your business and make fortune for you.">
	<meta name="revisit-after" content="30 days">
	<meta name="distribution" content="web">
	<meta name="copyright" content="KUSIAGA" />
	<meta name="keywords" content="business, link, shortener, link shortener">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/element-ui@1.4/lib/theme-default/index.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="aset/style.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 850px)" href="aset/small.css">
	<link rel="icon" href="aset/siaga.png">
	<title>Secure Link Shortener</title>
</head>
<body>

	<div class="main" id="app">
		<header>
			<div class="divide-bar">
				<img class="logo" src="aset/log-1.png">
			</div>
			<div class="divide-bar">
				<!-- <input class="form-control right-bar" type="text" name="" placeholder="Enter Address"> -->
				<nav class="_navbar">
					<div class="menu_nav">
						<ul>
							<li><p>New!</p></li>
							<li><a href="">Clipboard</a></li>
							<li><a href="">SI NILAI</a></li>
							<li><a href="">Developer</a></li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="divide-bar" style="float: right;">
				<div class="wrapper _hamburger">
					<span class="glyphicon glyphicon-menu-hamburger"></span>					
				</div>
			</div>
		</header>
		<div id="content">
			<div class="main-form" id="mainfrm" v-if="!show_result">
				<div class="headline">
					<h2>The New Face of Link Shortener</h2>
					<h4>Secure and Lead</h4>
				</div>
				<div class="alert alert-danger alert-dismissible" v-if="submitStatus_err">
				  <a href="#" class="close" data-dismiss="alert" @click="chgSubmitStatus" aria-label="close">&times;</a>
				  <strong>Failed</strong> Please check the fields again.
				</div>
				<div class="form-group urlgroup">
					<form id="submit-url" @submit.prevent="submitUrl">
					<p>Input Long URL</p>
					<input autofocus="true" id="url" class="longurl" type="url" name="longurl" placeholder="Input Long URL Here" v-model.trim="$v.longurl.$model" :class="status($v.longurl)" @input="delayTouch($v.longurl)">
					<button :disabled="$v.$invalid" :class="{'submit':!$v.$invalid}" type="text" class="submit-invalid" id="submit"><span v-if="!submitStatus">Shorten</span><span v-if="submitStatus"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</span></button>
					<span style="display: block; margin-left: 10px; color: red" id="urlerr"></span>
					 <div v-if="$v.longurl.$error">
					   <span style="display: block; margin-left: 10px; color: red" v-if="!$v.longurl.required">This Field cannot be blank</span>
					   <span style="display: block; margin-left: 10px; color: red" v-if="!$v.longurl.url">Please input a valid URL</span>
					</div> 
					<!-- <button class="customurl" id="custom"><span>Open URL Options</span></button> -->
					<div class="option-url">
						<p style="margin-top: 30px; text-align: center; font-weight: bold;">-- Link Options --</p>
						<div class="divide-option">
							<label>Custom URL</label>
							<small style="display: block;">https://kusia.ga/yourcustomurl</small>
							<div class='input-group date'>
			                    <input id="input-cstm" type='text' class="form-control" placeholder="Input Custom URL" name="customurl" v-model.trim="$v.customurl.$model" :class="status($v.customurl)" @input="delayTouch($v.customurl)" />
			                    <div class="loader" v-if="customstatus"></div>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-pencil"></span>
			                    </span>
			                </div>		
			                <span style="display: block; margin-left: 10px; color: red" id="customerr"></span>
					        <div v-if="$v.customurl.$error">
							   <span style="display: block; margin-left: 10px; color: red" v-if="!$v.customurl.nospace">Please input valid Custom URL</span>
							   <span style="display: block; margin-left: 10px; color: red" v-if="!$v.customurl.minLength">Custom URL must have at least 5 letter</span>
								<div v-if="$v.customurl.minLength">
								   	<span style="display: block; margin-left: 10px; color: red" v-if="!$v.customurl.isUnique">Custom URL has been taken by someone</span>
								</div>
							</div> 
						</div>
						<div class="divide-option">
							<label>URL Password</label>
							<small style="display: block;">Fill blank if you don't wish</small>
							<div class='input-group date'>
			                    <input id="input-pwd" type='Password' class="form-control" placeholder="Input Password" name="password" v-model="password" v-model.trim="$v.password.$model" :class="status($v.password)" @input="delayTouch($v.password)"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-eye-close"></span>
			                    </span>
			                </div>
			                <span style="display: block; margin-left: 10px; color: red" id="passerr"></span>
			                <div v-if="$v.password.$error">
							   <span style="display: block; margin-left: 10px; color: red" v-if="!$v.password.minLength">Password must have at least 6 letter</span>
							</div> 
						</div>
						<div class="divide-option">
							<label>Link Expiration</label>
							<small style="display: block;">Fill blank if you don't wish</small>
							<div class='input-group date' id='startDate'>
			                    <!-- <input id="input-date" type='text' class="form-control" name="expiration" v-model.trim="$v.expiration.$model"/> -->
								<date-picker name="expiration" v-model="expiration" :config="options"></date-picker>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</div>
					</div>
					</form>
				</div>
			</div>
			<!-- <contact-form/> -->
			<div v-if="show_result" id="hasil_short" class="result-link">
				<div class="form-short shrt">
				<p style="color: white; font-weight: bold;">Your Link Result : </p>
				<input id="short_res" type="text" readonly onfocus="javascript:select()" :value="resulturl" style="cursor: text; text-align:centre"><button id="btn-shrt" data-clipboard-target="#short_res" title="Copy"><span class="glyphicon glyphicon-copy"></span></button>
				<button id="newshrt" title="Shorten Again" @click="hideShowResult">Back to Home</button>
				</div>
			</div>
			<div class="link_stat">
				<h4 style="text-align: center; padding: 20px;">-- Stats --</h4>
				<div class="row">
					<div class="col-sm-6">
						<div class="right-right-bar right">
							<p>20 <small> Links Shorten</small></p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="right-right-bar left">
							<p>45,000 <small> Link Visitors</small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="footer-p">&copy; KUSIAGA 2018 | Build with KUSIAGA API</div>
		</div>	
	</div>

</body>
	<script type="text/javascript" src="https://kusia.ga/assets/js/jQuery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/vue@2.5/dist/vue.js"></script>
	<script src="https://unpkg.com/element-ui@1.4/lib/index.js"></script>
	<script src="//unpkg.com/element-ui@1.4/lib/umd/locale/en.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script>
	<script type="text/javascript" src="aset/vuelidate.min.js"></script>
	<script type="text/javascript" src="aset/validators.min.js"></script>
	<!-- Date-picker itself -->
	<!-- <script src="https://unpkg.com/pc-bootstrap4-datetimepicker@4.17/build/js/bootstrap-datetimepicker.min.js"></script> -->
	<!-- <link href="https://unpkg.com/pc-bootstrap4-datetimepicker@4.17/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> -->

	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/vue-bootstrap-datetimepicker@beta"></script>

	<!-- custom script -->
	<script type="text/javascript" src="aset/app.js"></script>
	
	<script>
	  ELEMENT.locale(ELEMENT.lang.en)
	</script>
<!-- 	<script type="text/javascript">
		
		var app = new Vue({
			el: '#app',
			data: function () {
				return {
					visible: false
				}
			}
		})
	</script> -->
<!-- 	 <script type="text/javascript">
        $(function () {
            $('#startDate').datetimepicker({
            	minDate: new Date()            	
            });
        });
    </script> -->
    <!-- custom -->
	<script type="text/javascript">
		$(function() {
	    new Clipboard('#btn-shrt');
		});	
	</script>

</html>