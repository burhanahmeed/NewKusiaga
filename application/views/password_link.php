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
	<link rel="stylesheet" href="https://unpkg.com/element-ui@1.4/lib/theme-default/index.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="aset/style.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 850px)" href="aset/small.css">
	<link rel="icon" href="aset/siaga.png">
	<title>Password Needed</title>
</head>
<body>

	<style type="text/css">
		.content {
			text-align: center;
			margin-top: 40px;
			padding: 30px;
		}
		.ads {
			margin: 0 auto;
			margin-top: 20px;
			display: block;
			text-align: center;
		}
		.ad-box {
			height: 90px;
			width: 730px;
			border: 1px solid white;
			padding: 30px;
			color: white;
			margin: 0 auto;
		}
		.main {
			min-height: 700px;
		}
		.pw_section {
			margin-top: 30px;
			color: white;
		}
		.btn-unlock{
			background-color: black;
		}
		@media screen and (max-width: 600px){
			.ads {
				margin-top: 10px;
			}
			.ad-box {
				height: 300px;
				width: 250px;
			}
			.main {
				min-height: auto;
			}
		}
	</style>

<div class="main" id="app">
	<header>
		<div class="divide-bar">
			<img class="logo" src="aset/log-1.png">
		</div>
		<div class="divide-bar" style="float: right;">
			
		</div>
	</header>
	<div class="content" v-if="!showExp">
		<p style="color: white"><span style="font-weight: bold;">You need to insert a password before proceeding to the link OR </span> <a href="/" style="color: white; padding: 7px; background-color: black;">Generate the New One?</a></p>

		<div class="pw_section">
			<template v-if="showError" @visible-change="onVisible">
				<el-alert @close="closeDialog()"
				    title="Password field cannot be blank"
				    type="error"
				    show-icon>
				</el-alert>
			</template>
			<template v-if="showPasswordError" @visible-change="onVisible">
				<el-alert @close="closeDialog()"
				    title="Password is incorrect"
				    type="error"
				    show-icon>
				</el-alert>
			</template>
			<h5>Enter password for https://kusia.ga/<?= $short_url ?></h5>
			<form @submit.prevent="submitpassword">
				<div class="form-group">
					<input type="password" name="password" v-model="password" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-unlock">Unlock</button>
				</div>
			</form>
		</div>
 
	</div>
	<div class="content" v-if="showExp">
		<p style="color: white"><span style="font-weight: bold;">The URL you requested has been expired, Please contact the owner OR </span> <a href="/" style="color: white; padding: 7px; background-color: black;">Generate the New One?</a></p>
		<img src="aset/expired.jpg">
	</div>
	<div class="ads">
		<div class="ad-box">
			<p>So, What can you see here?</p>
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
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<script type="text/javascript">
		var short_url = <?php echo $encoded_short ?>
	</script>
	<!-- custom script -->
	<script type="text/javascript" src="aset/password.js"></script>

</html>