<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Begin styles Rendering -->
	<link href="/assets/css/bootstrap-combined.min.css" rel="stylesheet">
	<!-- End styles Rendering -->

	<link rel="shortcut icon" href="/assets/img/crisis.ico" />

	<!-- html5.js & media-queries.js (fallback) --> 
	<!--[if lt IE 9]> 
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> 
	<![endif]-->

	<style>
		/***
		Error Pages
		***/

		/* 404 page option #1 */

		.page-404 {
		  text-align: center;
		}

		.page-404 .number {
		  display: inline-block;
		  letter-spacing: -10px;
		  margin-top: 0px;
		  line-height: 128px;
		  font-size: 158px;
		  font-weight: 300;
		  color: #7bbbd6;
		  text-align: right;
		}

		.page-404 .details {
		  margin-left: 40px;
		  display: inline-block;
		  padding-top: 0px;
		  text-align: left;
		}

		/* 500 page option #1 */
		.page-500 {
		  text-align: center;
		}

		.page-500 .number {  
		  display: inline-block;
		  letter-spacing: -10px;
		  line-height: 128px;
		  font-size: 158px;
		  font-weight: 300;
		  color: #ec8c8c;
		  text-align: right;
		}

		.page-500 .details {
		  margin-left: 40px;
		  display: inline-block;
		  text-align: left;
		}

		/* 404 page option #2*/
		.page-404-full-page {
		  padding: 20px;
		  background-color: #fafafa !important;
		}

		.page-404-full-page .details input {
		  background-color: #ffffff;
		}

		.page-404-full-page .page-404 {
		  margin-top: 100px;
		}

		/* 500 page option #2*/
		.page-500-full-page {
		  padding: 20px;
		  background-color: #fafafa !important;
		}

		.page-500-full-page .details input {
		  background-color: #ffffff;
		}

		.page-500-full-page .page-500 {
		  margin-top: 100px;
		}

		/* 404 page option #3*/

		.page-404-3 {
		  background: #000 !important ;
		} 

		.page-404-3 .page-inner img {
		  right: 0;
		  bottom: 0;
		  z-index: -1;
		  position: absolute;
		}

		.page-404-3 .error-404 {
		  color: #fff;
		  text-align: left;
		  padding: 70px 20px 0;
		}

		.page-404-3 h1 {
		  color: #fff;
		  font-size: 130px;
		  line-height: 160px;
		}

		.page-404-3 h2 {
		  color: #fff;
		  font-size: 30px;
		  margin-bottom: 30px;
		}

		.page-404-3 p {
		  color: #fff;
		  font-size: 16px;
		}


		@media (max-width: 480px) { 

		  .page-404 .number,
		  .page-500 .number,
		  .page-404 .details,
		  .page-500 .details {
		    text-align: center;
		    margin-left: 0px;
		  }

		  .page-404-full-page .page-404 {
		    margin-top: 30px;
		  }

		  .page-404-3 .error-404 {
		    text-align: left;
		    padding-top: 10px;
		  }

		  .page-404-3 .page-inner img {
		    right: 0;
		    bottom: 0;
		    z-index: -1;
		    position: fixed;
		  }

		}
	</style>

</head>
<body class="page-404-full-page">

	<div class="container">

		<div class="row-fluid">

			<div class="span12 page-404">

				<div class="number">

					404

				</div>

				<div class="details">
				<br/>
					无法找到服务器地址：<?php echo $_REQUEST['p'];?>, 请检查重试！

				</div>

			</div>

		</div>


	</div>

	<script src="/assets/js/jquery-all.js?v=1401099113"></script>
	<script src="/assets/js/bootstrap-all.js?v=1398835911"></script>

	</body>
</html>
