<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherStation</title>
    <!-- Page Title bar -->
    <link rel="icon" type="image/png" href="./src/logo/title icon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./src/style.css">

    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                <h1 class="col-12 col-sm-11 col-md-8 col-lg-6 col-xl-7">Welcome to Smart Weather Monitoring System!</h1>

                <p class="card-text col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">Stay updated with real-time
                    environmental data collected from your local sensor
                    station.</p>

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
                <h1 class="col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">Live Weather Data
                    Monitoring</h1>
                </h1>

                <p class="card-text col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                    </svg> Padukka
                </p>
                <div class="row justify-content-center">
                    <!-- Rain card -->
                    <div class="col-11 col-sm-11 col-md-9 col-lg-4 col-xl-3 m-4">
                        <div class="card crd shadow"
                            style="text-align: start;padding: 10px; padding-bottom: 35px;border-radius: 15px;background-color: #EDEDED;">
                            <div class="card-body">
                                <svg style="position: absolute;right: 27px;top: 34px;"
                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-cloud-lightning-rain-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.658 11.026a.5.5 0 0 1 .316.632l-.5 1.5a.5.5 0 1 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.316m9.5 0a.5.5 0 0 1 .316.632l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.316m-7.5 1.5a.5.5 0 0 1 .316.632l-.5 1.5a.5.5 0 1 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.316m9.5 0a.5.5 0 0 1 .316.632l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.316m-7.105-1.25A.5.5 0 0 1 7.5 11h1a.5.5 0 0 1 .474.658l-.28.842H9.5a.5.5 0 0 1 .39.812l-2 2.5a.5.5 0 0 1-.875-.433L7.36 14H6.5a.5.5 0 0 1-.447-.724zm6.352-7.249a5.001 5.001 0 0 0-9.499-1.004A3.5 3.5 0 1 0 3.5 10H13a3 3 0 0 0 .405-5.973" />
                                </svg>
                                <h5 class="card-title" style="font-weight: bold;">Rain</h5>
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>

                                <script>
                                    const ctx = document.getElementById('myChart');

                                    const labels = Array.from({
                                        length: 24
                                    }, (_, i) => i.toString().padStart(1, '0') + ':00');

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            labels: labels,
                                            datasets: [{
                                                label: 'Rain Data',
                                                data: [1, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0,
                                                    1, 0, 1, 0
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    min: 0,
                                                    max: 1,
                                                    ticks: {
                                                        stepSize: 1
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Rain or Not (0 or 1)'
                                                    }
                                                },
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Hour of Day'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- Air Quality card -->
                    <div class="col-11 col-sm-11 col-md-9 col-lg-4 col-xl-3 m-4">
                        <div class="card crd shadow"
                            style="text-align: start;padding: 10px; padding-bottom: 35px;border-radius: 15px;background-color: #EDEDED;">
                            <div class="card-body">
                                <svg style="position: absolute;right: 27px;top: 34px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-wind" viewBox="0 0 16 16">
                                    <path d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5m-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2M0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5" />
                                </svg>
                                <h5 class="card-title" style="font-weight: bold;">Air quality</h5>
                                <div>
                                    <canvas id="myChart2"></canvas>
                                </div>
                                <center>
                                    <span style="font-weight: bolder; font-size: x-large; margin: 0;color: green;"> Healthy</span>
                                </center>

                                <script>
                                    const ctx2 = document.getElementById('myChart2');

                                    const labels2 = Array.from({
                                        length: 24
                                    }, (_, i) => i.toString().padStart(1, '0') + ':00');

                                    new Chart(ctx2, {
                                        type: 'line',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            // labels: labels2,
                                            datasets: [{
                                                label: 'Rain Data',
                                                data: [1, 5, 1, 3, 1, 7, 1],
                                                borderWidth: 1
                                            }, {
                                                label: 'Rain Data',
                                                data: [1, 5, 2, 2, 1, 7, 1],
                                                borderWidth: 1
                                            }, {
                                                label: 'Rain Data',
                                                data: [1, 5, 1, 2, 6, 7, 1],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    min: 0,
                                                    max: 10,
                                                    ticks: {
                                                        stepSize: 1
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Rain or Not (0 or 1)'
                                                    }
                                                },
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Hour of Day'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- Valtage card -->
                    <div class="col-11 col-sm-11 col-md-9 col-lg-4 col-xl-3 m-4">
                        <div class="card crd shadow"
                            style="text-align: start;padding: 10px; padding-bottom: 35px;border-radius: 15px;background-color: #EDEDED;">
                            <div class="card-body">

                                <svg style="position: absolute;right: 27px;top: 34px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-battery-charging" viewBox="0 0 16 16">
                                    <path d="M9.585 2.568a.5.5 0 0 1 .226.58L8.677 6.832h1.99a.5.5 0 0 1 .364.843l-5.334 5.667a.5.5 0 0 1-.842-.49L5.99 9.167H4a.5.5 0 0 1-.364-.843l5.333-5.667a.5.5 0 0 1 .616-.09z" />
                                    <path d="M2 4h4.332l-.94 1H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h2.38l-.308 1H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2" />
                                    <path d="M2 6h2.45L2.908 7.639A1.5 1.5 0 0 0 3.313 10H2zm8.595-2-.308 1H12a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9.276l-.942 1H12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                                    <path d="M12 10h-1.783l1.542-1.639q.146-.156.241-.34zm0-3.354V6h-.646a1.5 1.5 0 0 1 .646.646M16 8a1.5 1.5 0 0 1-1.5 1.5v-3A1.5 1.5 0 0 1 16 8" />
                                    <!-- <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" /> -->
                                </svg>
                                <h5 class="card-title" style="font-weight: bold;">Solar Power System</h5>
                                <div>
                                    <canvas id="myChart3"></canvas>
                                </div>
                                <center>
                                    <span style="font-weight: bolder; font-size: x-large; margin: 0;color: green;">Charging</span>
                                </center>

                                <script>
                                    const ctx3 = document.getElementById('myChart3');

                                    const labels3 = Array.from({
                                        length: 24
                                    }, (_, i) => i.toString().padStart(1, '0') + ':00');

                                    new Chart(ctx3, {
                                        type: 'line',
                                        data: {
                                            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            labels: labels3,
                                            datasets: [{
                                                label: 'Voltage Data',
                                                data: [0, 0, 0, 0, 0, 0, 0, 2, 2.5, 2.9, 3.8, 4, 4.5, 4.9, 4.9, 4.2, 3, 2.2, 1, 0, 0, 0, 0, 0],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    min: 0,
                                                    max: 5,
                                                    ticks: {
                                                        stepSize: 1
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Voltages (V)'
                                                    }
                                                },
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Hour of Day'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- Temperature card -->
                    <div class="col-11 col-sm-11 col-md-9 col-lg-4 col-xl-3 m-4">
                        <div class="card crd shadow"
                            style="text-align: start;padding: 10px; padding-bottom: 35px;border-radius: 15px;background-color: #EDEDED;">
                            <div class="card-body">

                                <svg style="position: absolute;right: 27px;top: 34px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-thermometer-sun" viewBox="0 0 16 16">
                                    <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V2.5a.5.5 0 0 1 1 0v8.585A1.5 1.5 0 0 1 5 12.5" />
                                    <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1m5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5m4.243 1.757a.5.5 0 0 1 0 .707l-.707.708a.5.5 0 1 1-.708-.708l.708-.707a.5.5 0 0 1 .707 0M8 5.5a.5.5 0 0 1 .5-.5 3 3 0 1 1 0 6 .5.5 0 0 1 0-1 2 2 0 0 0 0-4 .5.5 0 0 1-.5-.5M12.5 8a.5.5 0 0 1 .5-.5h1a.5.5 0 1 1 0 1h-1a.5.5 0 0 1-.5-.5m-1.172 2.828a.5.5 0 0 1 .708 0l.707.708a.5.5 0 0 1-.707.707l-.708-.707a.5.5 0 0 1 0-.708M8.5 12a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5" />
                                </svg>
                                <h5 class="card-title" style="font-weight: bold;">Temperature</h5>
                                <div>
                                    <canvas id="myChart4"></canvas>
                                </div>
                                <center>
                                    <span style="font-weight: bolder; font-size: x-large; margin: 0;color: green;">Good</span>
                                </center>

                                <script>
                                    const ctx4 = document.getElementById('myChart4');

                                    const labels4 = Array.from({
                                        length: 24
                                    }, (_, i) => i.toString().padStart(1, '0') + ':00');

                                    new Chart(ctx4, {
                                        type: 'line',
                                        data: {
                                            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            labels: labels4,
                                            datasets: [{
                                                label: 'Temperature Data',
                                                data: [30, 30, 30, 30, 30, 30, 30, 32, 33, 33, 34, 34, 33, 31, 31, 31, 31, 30, 29, 30, 30, 30, 30, 30],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    min: 0,
                                                    max: 50,
                                                    ticks: {
                                                        stepSize: 1
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Temperature (Celsius)'
                                                    }
                                                },
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Hour of Day'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- Temperature card -->
                    <div class="col-11 col-sm-11 col-md-9 col-lg-4 col-xl-3 m-4">
                        <div class="card crd shadow"
                            style="text-align: start;padding: 10px; padding-bottom: 35px;border-radius: 15px;background-color: #EDEDED;">
                            <div class="card-body">

                                <svg style="position: absolute;right: 27px;top: 34px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-thermometer-sun" viewBox="0 0 16 16">
                                    <path d="M10 3c0 1.313-.304 2.508-.8 3.4a2 2 0 0 0-1.484-.38c-.28-.982-.91-2.04-1.838-2.969a8 8 0 0 0-.491-.454A6 6 0 0 1 8 2c.691 0 1.355.117 1.973.332Q10 2.661 10 3m0 5q0 .11-.012.217c1.018-.019 2.2-.353 3.331-1.006a8 8 0 0 0 .57-.361 6 6 0 0 0-2.53-3.823 9 9 0 0 1-.145.64c-.34 1.269-.944 2.346-1.656 3.079.277.343.442.78.442 1.254m-.137.728a2 2 0 0 1-1.07 1.109c.525.87 1.405 1.725 2.535 2.377q.3.174.605.317a6 6 0 0 0 2.053-4.111q-.311.11-.641.199c-1.264.339-2.493.356-3.482.11ZM8 10c-.45 0-.866-.149-1.2-.4-.494.89-.796 2.082-.796 3.391q0 .346.027.678A6 6 0 0 0 8 14c.94 0 1.83-.216 2.623-.602a8 8 0 0 1-.497-.458c-.925-.926-1.555-1.981-1.836-2.96Q8.149 10 8 10M6 8q0-.12.014-.239c-1.02.017-2.205.351-3.34 1.007a8 8 0 0 0-.568.359 6 6 0 0 0 2.525 3.839 8 8 0 0 1 .148-.653c.34-1.267.94-2.342 1.65-3.075A2 2 0 0 1 6 8m-3.347-.632c1.267-.34 2.498-.355 3.488-.107.196-.494.583-.89 1.07-1.1-.524-.874-1.406-1.733-2.541-2.388a8 8 0 0 0-.594-.312 6 6 0 0 0-2.06 4.106q.309-.11.637-.199M8 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                </svg>
                                <h5 class="card-title" style="font-weight: bold;">Air pressure</h5>

                                <center>
                                    <span style="font-weight: bolder; font-size: x-large; margin: 0;color: green;">200P</span>
                                </center>

                            </div>
                        </div>
                    </div>

                </div>
            </center>
        </div>

    </div>
    <!-- sec-03 -->
    <div class="container-fluid text-light" id="sec-3"
        style="background: #1E1E1E; padding-top: 70px; padding-bottom: 70px;">
        <style>
            h1 {
                font-weight: bold;
            }
        </style>
        <div class="row justify-content-center">

            <div class="container">
                <center>
                    <h1>About This Weather Station</h1>
                    <p class="text-center col-11 col-sm-11 col-md-9 col-lg-7 col-xl-7">
                        The Smart Weather Station is an IoT-based environmental monitoring system designed to collect, analyze, and display real-time weather data using low-cost sensors and microcontroller technology.

                        Developed as part of a practical IoT project, this station uses an ESP32 microcontroller to gather data from multiple sensors and transmits it to a centralized dashboard for easy visualization.
                    </p>
                    <div style="margin-top: 50px;margin-bottom: 50px;"
                        class=" col-12 col-sm-11 col-md-8 col-lg-6 col-xl-6">
                        <a href="./history.php" style="border-radius: 15px;">
                            <button type="button" class="btn btn-success cst-btn m-3 cst-bg">See Old data
                            </button>
                        </a>
                    </div>
                </center>

            </div>

        </div>
        <!-- footer -->
        <?php require './pg/footer.php'; ?>


        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>
</body>

</html>