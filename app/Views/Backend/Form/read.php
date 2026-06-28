<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= route_to('admin.form.list',$form_code) ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <?php foreach($data as $field):?>
                        <div class="form-group">
                            <?php if($field['value']):?>
                                <label for="inputName" class="col-form-label"><?= $field['label'] ?></label>
                            <?php endif;?>
                            <?php if(!is_array($field['value'])):?>
                                <?php if($field['type']=='textarea'):?>
                                    <div class="input-group">
                                        <textarea type="text" rows="5" name="title" class="form-control" ><?= $field['value'] ? esc($field['value']) :'' ?></textarea>
                                    </div>
                                <?php elseif($field['value']&&$field['label']!='&nbsp;'):?>
                                    <div class="input-group">
                                        <input type="text" name="title" class="form-control" value="<?= $field['value'] ? esc($field['value']) :'' ?>" >
                                    </div>
                                <?php endif;?>

                            <?php endif;?>
                            <?php if(is_array($field['value'])):?>
                                <div class="input-group">
                                    <ul class="list-group">
                                        <?php foreach($field['value'] as $file):?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($file['origin']) ?>
                                          <a class="badge badge-primary badge-pill" target="_blank" href="<?= route_to('download', $file['media_id']) ?>">download</a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                        
                                </div>
                            <?php endif;?>
                        </div>
                        <?php endforeach;?>
                        <p><?= $submit['form_code']?></p>
                        <p>IP:<?= $submit['ip']?></p>
                        <p>USER_AGENT:<?= $submit['user_agent']?></p>
                        <p>DATE:<?= $submit['created_at']?></p>
                    </div>
                    
                </div>
                
                
                
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

