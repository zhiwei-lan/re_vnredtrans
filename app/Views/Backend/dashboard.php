<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow">
            <div class="card-body">
                <div class="text-primary font-weight-bold text-uppercase mb-1">Total Members</div>
                <div class="h3 mb-0">
                    <span class="text-primary"><?= $totalMembers ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-success shadow">
            <div class="card-body">
                <div class="text-success font-weight-bold text-uppercase mb-1">Total Articles</div>
                <div class="h3 mb-0">
                    <span class="text-success"><?= $totalArticles ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow">
            <div class="card-body">
                <div class="text-warning font-weight-bold text-uppercase mb-1">Form Submissions</div>
                <div class="h3 mb-0">
                    <span class="text-warning"><?= $totalSubmissions ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Server Information -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0"><i class="fas fa-server"></i> Server Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 40%;">Operating System:</td>
                            <td><?= php_uname() ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Server Software:</td>
                            <td><?= $_SERVER['SERVER_SOFTWARE'] ?? 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Server IP:</td>
                            <td><?= $_SERVER['SERVER_ADDR'] ?? 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Current IP:</td>
                            <td><?= $_SERVER['REMOTE_ADDR'] ?? 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Root Directory:</td>
                            <td><small><?= ROOTPATH ?></small></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Upload Limit:</td>
                            <td><?= ini_get('upload_max_filesize') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PHP Environment -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="m-0"><i class="fas fa-code"></i> PHP Environment</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 40%;">PHP Version:</td>
                            <td>
                                <span class="badge bg-success"><?= phpversion() ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">CodeIgniter:</td>
                            <td><span class="badge bg-primary"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Environment:</td>
                            <td>
                                <span class="badge <?= ENVIRONMENT === 'production' ? 'bg-danger' : 'bg-warning' ?>">
                                    <?= ENVIRONMENT ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Max Execution Time:</td>
                            <td><?= ini_get('max_execution_time') ?> seconds</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Memory Limit:</td>
                            <td><?= ini_get('memory_limit') ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Error Reporting:</td>
                            <td><?= ini_get('display_errors') ? 'Enabled' : 'Disabled' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Database Information -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h6 class="m-0"><i class="fas fa-database"></i> Database Information</h6>
            </div>
            <div class="card-body">
                <?php
                try {
                    $db = \Config\Database::connect();
                    $platform = $db->getPlatform();
                    $version = $db->getVersion();
                ?>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 40%;">Database Type:</td>
                            <td><?= $platform ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Database Version:</td>
                            <td><?= $version ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Database Name:</td>
                            <td><?= $db->getDatabase() ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Connection Status:</td>
                            <td><span class="badge bg-success">Connected</span></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                } catch (\Throwable $e) {
                ?>
                <div class="alert alert-danger mb-0">
                    <i class="fas fa-exclamation-circle"></i> Database Connection Failed
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- PHP Extensions -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h6 class="m-0"><i class="fas fa-cube"></i> Required Extensions</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 40%;">PDO:</td>
                            <td>
                                <span class="badge <?= extension_loaded('pdo') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= extension_loaded('pdo') ? 'Installed' : 'Not Installed' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">MySQL/MySQLi:</td>
                            <td>
                                <span class="badge <?= extension_loaded('mysqli') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= extension_loaded('mysqli') ? 'Installed' : 'Not Installed' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">cURL:</td>
                            <td>
                                <span class="badge <?= extension_loaded('curl') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= extension_loaded('curl') ? 'Installed' : 'Not Installed' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">GD:</td>
                            <td>
                                <span class="badge <?= extension_loaded('gd') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= extension_loaded('gd') ? 'Installed' : 'Not Installed' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">JSON:</td>
                            <td>
                                <span class="badge <?= extension_loaded('json') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= extension_loaded('json') ? 'Installed' : 'Not Installed' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">OpenSSL:</td>
                            <td>
                                <span class="badge <?= extension_loaded('openssl') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= extension_loaded('openssl') ? 'Installed' : 'Not Installed' ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>