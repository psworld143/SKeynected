<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Budget Request</title>
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/budget.css">
    <link rel="stylesheet" href="../assets/css/mains.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>

<body>
    <section class="section">
        <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                <div id="budgetChart" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" class="echart" _echarts_instance_="ec_1727786903765">
                    <div style="position: relative; width: 774px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="967" height="500" style="position: absolute; left: 0px; top: 0px; width: 774px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                            legend: {
                                data: ['Allocated Budget', 'Actual Spending']
                            },
                            radar: {
                                // shape: 'circle',
                                indicator: [{
                                        name: 'Sales',
                                        max: 6500
                                    },
                                    {
                                        name: 'Administration',
                                        max: 16000
                                    },
                                    {
                                        name: 'Information Technology',
                                        max: 30000
                                    },
                                    {
                                        name: 'Customer Support',
                                        max: 38000
                                    },
                                    {
                                        name: 'Development',
                                        max: 52000
                                    },
                                    {
                                        name: 'Marketing',
                                        max: 25000
                                    }
                                ]
                            },
                            series: [{
                                name: 'Budget vs spending',
                                type: 'radar',
                                data: [{
                                        value: [4200, 3000, 20000, 35000, 50000, 18000],
                                        name: 'Allocated Budget'
                                    },
                                    {
                                        value: [5000, 14000, 28000, 26000, 42000, 21000],
                                        name: 'Actual Spending'
                                    }
                                ]
                            }]
                        });
                    });
                </script>

            </div>
        </div>
    </section>
    <?php include './modal/budget-request-modal.php' ?>


    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>


    <script src="../assets/js/main.js"></script>

    <script>
        // Initialize DataTable for the budget requests table
        document.addEventListener("DOMContentLoaded", function() {
            let budgetTable = document.querySelector('#budgetRequestTable');
            if (budgetTable) {
                new simpleDatatables.DataTable(budgetTable);
            }
        });
    </script>
</body>

</html>