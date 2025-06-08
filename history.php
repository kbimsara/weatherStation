<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notesketch</title>
    <!-- Page Title bar -->
    <link rel="icon" type="image/png" href="./src/logo/title icon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./src/style.css">

    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AJEX cdm -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <!-- nav -->
    <?php require_once './pg/nav.php'; ?>

    <!-- sec-01 -->
    <div class="container-fluid text-white justify content center" id="sec-1" style="height: 400px; padding-top: 80px;background-image: url('./src/img/banner.gif'); background-repeat : no-repeat; background-size: cover;">
        <div>
            <style>
                h1 {
                    font-weight: bold;
                }
            </style>
            <center>
                <h1 class="col-12 col-sm-11 col-md-8 col-lg-6 col-xl-7">Weather Data History</h1>

                <p class="card-text col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">Explore historical environmental data collected by your smart weather station. View detailed logs of temperature, humidity, air quality, rainfall, and more <br> all timestamped and downloadable for further analysis.</p>

            </center>
        </div>

    </div>

    <!-- sec-02 -->
    <div class="container-fluid bg-white justify content center" id="sec-2"
        style="padding-bottom: 70px; padding-top: 70px;">
        <div>
            <style>
                h1 {
                    font-weight: bold;
                }
            </style>
            <center>
                <h1 class="col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">Select Date Range</h1>
                </h1>
                <!-- location -->
                <p class="card-text col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                    </svg> Kalutara
                </p>
                <!-- filter row -->
                <div class="container">
                    <div class="row justify-content-center">
                        <!-- Duration and Date Range -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 p-2">
                            <label for="duration">Filter by : </label>
                            <select name="duration" id="duration" class="btn btn-info dropdown-toggle" oninvalid="this.setCustomValidity('Please Seletc Option For Search')" onchange="FetchDuration(this.value)">
                                <option>Choose...</option>
                                <option value="day">Day (24h)</option>
                                <option value="week">Week (7D)</option>
                                <option value="month">Month (4W)</option>
                                <option value="year">Year (12M)</option>
                                <option value="all">More</option>
                            </select>

                            <button type="button" id="downloadCSVBtn" class="btn btn-outline-success m-2">Download</button>
                        </div>
                    </div>
                </div>
                <script>
                    $('#downloadCSVBtn').on('click', function() {
                        const selectedDuration = $('#duration').val(); // use correct selector
                        const downloadUrl = `DB File/download_csv.php?duration=${encodeURIComponent(selectedDuration)}`;
                        window.location.href = downloadUrl;
                    });
                </script>
                <!-- table content -->
                <div class="row justify-content-center" style="margin-top: 30px;">
                    <!-- table content -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-11 col-xl-11 table-responsive" style="overflow-x: auto;">
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Temperatur</th>
                                    <th scope="col">Humidity</th>
                                    <th scope="col">Pressure</th>
                                    <th scope="col">Altitude</th>
                                    <th scope="col">Air Quality</th>
                                    <th scope="col">Air Quality Status</th>
                                    <th scope="col">Rain Detection</th>
                                    <th scope="col">Rain Value</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody id="data-tb">
                                <!-- AJAX content goes here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center" id="pagination">
                        <!-- AJAX pagination goes here -->
                    </ul>
                </nav>
            </center>
        </div>

    </div>

    <?php require './pg/footer.php'; ?>


    <!-- JS -->
    <script>
        let selectedDuration = ''; // Store selected duration globally

        function loadData(page = 1) {
            $.ajax({
                url: "./DB File/fetch_data.php",
                type: "GET",
                data: {
                    page: page,
                    duration: selectedDuration
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    $("#data-tb").html(res.table);
                    $("#pagination").html(res.pagination);
                }
            });
        }

        function FetchDuration(dt) {
            selectedDuration = dt;
            loadData(); // reload data with selected duration
            // console.log("droped: " + dt); // Debugging line to check duration value
        }

        $(document).ready(function() {
            loadData(); // initial load
            // console.log("Doc :"+selectedDuration); // Debugging line to check duration value


            $(document).on("click", ".page-link", function(e) {
                e.preventDefault();
                const page = $(this).data("page");
                if (page) {
                    loadData(page);
                }
            });
        });
    </script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>