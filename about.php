<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | eGovern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <style>
         .jumbotron {
            background-image: url("assets/img/y-so-serious-white.png");
        }
    
        .title {
            font-family: "Century Gothic";
            font-weight: bolder;
            color: black;
            text-shadow: 2px 2px cadetblue;
        }
        .sub-title {
            font-family: "Century Gothic";
            font-weight: bolder;
            color: black;

        }
 
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand {
            font-weight: bold;
        }
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            color: #007bff;
            margin-bottom: 10px;
        }

        .section-title p {
            font-size: 18px;
            color: #6c757d;
        }

        .team-member {
            text-align: center;
        }

        .team-member img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .team-member h5 {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .team-member .role {
            color: #6c757d;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 40px;
        }
    </style>
</head>

<body >
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container ">
            <a class="navbar-brand" href="login.php">
                <i class="fa fa-home"></i> eGovern
            </a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-5">
        <div class="container ">
            <div class="section-title">

			<nav class="navbar bg-body-tertiary">
  <div class="container-fluid jumbotron">
  <a class="navbar-brand" href="#">
      <img src="logo.png" alt="Bootstrap" width="100%" height="20%">
    </a>    
   
  </div>
</nav>
              
            </div>

            <div class="row ">
                <div class="col-lg-4">
                    <?php include 'assets/svg/svg.php'; ?>
                </div>
                <div class="col-lg-8">
                    <h3 class="sub-title " >VISION</h3>
                    <hr>
                    <p class="sub-title " >
                        We envision CULIONG as a progressive, clean, peaceful, and self-reliant community, with well-dedicated, healthy, and God-fearing residents, participative in clean and green activities headed by dedicated and transparent leaders.
                    </p>
                    <h3 class="sub-title ">MISSION</h3>
                    <hr>
                    <p class="sub-title">
                        With our strong faith in God, we work together to make our barangay progressive by developing infrastructure, providing facilities for economic development, improving farm-to-market roads, and maintaining peace and order. We actively participate in clean and green programs to uplift our community.
                    </p>
                </div>
            </div>

			<div class="section-title">
    <h3 class="title ">Meet the Team</h3>
</div>

<div class="container ">
    <div class="row justify-content-center">
        <!-- Team Member Card 1 -->
        <div class="col-xl-2 col-md-3 mb-3">
            <div class="card border-0 shadow-sm jumbotron">
                <div class="d-flex justify-content-center mt-3">
                    <img src="assets/img/ghenly.jpg" class="rounded-circle" alt="Mark Ghenly Murao" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="card-body text-center jumbotron">
                    <h5 class="card-title mb-2">MURAO, MARK GHENLY J.</h5>
                    <p class="card-text text-black-50 fs-6" style="font-size: 14px; line-height: 1.5; margin-bottom: 0;">
                        <strong>Role:</strong> Project Manager <br>
                        
                        Programmer and Developer
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Member Card 2 -->
        <div class="col-xl-2 col-md-3 mb-3">
            <div class="card border-0 shadow-sm jumbotron">
                <div class="d-flex justify-content-center mt-3">
                    <img src="assets/img/joana.jpg" class="rounded-circle" alt="Joanna Baylen" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="card-body text-center jumbotron">
                    <h5 class="card-title mb-2">BAYLEN, JOANNA</h5>
                    <p class="card-text text-black-50 fs-6" style="font-size: 14px; line-height: 1.5; margin-bottom: 0;">
                        <strong>Role:</strong> System Analyst and Designer <br>
                        Programmer and Developer 
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Member Card 3 -->
        <div class="col-xl-2 col-md-3 mb-3">
            <div class="card border-0 shadow-sm jumbotron">
                <div class="d-flex justify-content-center mt-3">
                    <img src="assets/img/angelyn.jpg" class="rounded-circle" alt="Angielyn Adriosola" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="card-body text-center jumbotron">
                    <h5 class="card-title mb-2">ADRIOSOLA, ANGIELYN</h5>
                    <p class="card-text text-black-50 fs-6" style="font-size: 14px; line-height: 1.5; margin-bottom: 0;">
                        <strong>Role:</strong> Documenter/Technical Writer
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Member Card 4 -->
        <div class="col-xl-2 col-md-3 mb-3">
            <div class="card border-0 shadow-sm jumbotron">
                <div class="d-flex justify-content-center mt-3">
                    <img src="assets/img/elyza.jpg" class="rounded-circle" alt="Elyza V. Cunanan" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="card-body text-center jumbotron">
                    <h5 class="card-title mb-2">CUNANAN, ELYZA V.</h5>
                    <p class="card-text text-black-50 fs-6" style="font-size: 14px; line-height: 1.5; margin-bottom: 0;">
                        <strong>Role:</strong> QA / Tester <br>
                        Documenter/Technical Writer
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Member Card 5 -->
        <div class="col-xl-2 col-md-3 mb-3">
            <div class="card border-0 shadow-sm jumbotron">
                <div class="d-flex justify-content-center mt-3">
                    <img src="assets/img/harry.jpg" class="rounded-circle" alt="Mark Laurence Harry" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="card-body text-center jumbotron">
                    <h5 class="card-title mb-2">MARK LAURENCE HARRY</h5>
                    <p class="card-text text-black-50 fs-6" style="font-size: 14px; line-height: 1.5; margin-bottom: 0;">
                        <strong>Role:</strong> Documenter/Technical Writer
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>




    </section>

    <footer>
        &copy; eGovern System Management - Salcedo Ilocos Sur <?= date("Y") ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
