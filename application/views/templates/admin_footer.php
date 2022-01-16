<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Peramalan Roti Woke 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo site_url(); ?>user_auth/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/chart.js/Chart.min.js"></script>

<!-- DataTables plugins -->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>

<!-- Custom Alert -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>

<!-- Custom JS -->
<script src="<?php echo base_url(); ?>assets/js/custom-script.js"></script>

<script>
    $(document).ready(function() {
        // Set new default font family and font color to mimic Bootstrap's default styling
        (Chart.defaults.global.defaultFontFamily = "Nunito"),
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = "#858796";

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + "").replace(",", "").replace(" ", "");
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
                dec = typeof dec_point === "undefined" ? "." : dec_point,
                s = "",
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return "" + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || "").length < prec) {
                s[1] = s[1] || "";
                s[1] += new Array(prec - s[1].length + 1).join("0");
            }
            return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("diagramVarian");
        var uniq = <?php echo json_encode($uniq_month); ?>;
        var months = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        let labels = uniq.map(item => months[item.bulan - 1]);

        let predictedResult = <?php echo json_encode($prediksi); ?>;

        let dataAktual = predictedResult.map(item => item.total_penjualan);
        let dataPrediksi = predictedResult.map(item => item.prediksi);

        let maxDataAktual = Math.max(...dataAktual);
        let maxDataPrediksi = Math.max(...dataPrediksi);

        let max = (maxDataAktual > maxDataPrediksi) ? maxDataAktual : maxDataPrediksi;

        var myBarChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                        label: "Data Aktual",
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        data: dataAktual,
                    },
                    {
                        label: "Data Prediksi",
                        backgroundColor: "#000080",
                        hoverBackgroundColor: "#000034",
                        borderColor: "#000080",
                        data: dataPrediksi,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0,
                    },
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: "month",
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            maxTicksLimit: 24,
                        },
                        maxBarThickness: 100,
                    }, ],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: max,
                            maxTicksLimit: 10,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value);
                            },
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2],
                        },
                    }, ],
                },
                legend: {
                    display: false,
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: "#6e707e",
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel =
                                chart.datasets[tooltipItem.datasetIndex].label || "";
                            return datasetLabel + ": " + number_format(tooltipItem.yLabel);
                        },
                    },
                },
            },
        });
    });
</script>

</body>

</html>