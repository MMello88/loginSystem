<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="32x32" href="<?= base_url('assets/images/ico/ico.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/ico/ico.png') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>MatiLab - Accounts</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
	<link rel="canonical" href="https://getbootstrap.com/docs/4.3/components/navbar/">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script>
		var base_url = "<?= base_url(); ?>";
	</script>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light border-bottom shadow-sm p-3 mb-5 bg-white rounded">
        <div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>"><b>MatiLab</b></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup" >
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href=""><b>Sobre</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Curte nós no Facebook" data-placement="bottom" href="https://www.facebook.com/" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Segue nós no Instagram" data-placement="bottom" href="https://www.instagram.com/" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    