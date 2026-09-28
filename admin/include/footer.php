<?php
/**
 * Admin layout - bottom half. Pages may set $pageScripts to load extra JS files.
 */
defined('APP_ROOT') || exit;
?>
            </div><!-- /.container-fluid -->
        </div><!-- /#content -->

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Attendance System <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
    </div><!-- /#content-wrapper -->
</div><!-- /#wrapper -->

<a class="scroll-to-top rounded" href="#page-top" aria-label="Scroll to top"><i class="fas fa-angle-up"></i></a>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/sb-admin-2.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendor/toastr/toastr.min.js"></script>
<script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/custom/js/app.js"></script>
<?php foreach ($pageScripts ?? [] as $script): ?>
    <script src="<?= e($script) ?>"></script>
<?php endforeach; ?>
</body>
</html>
