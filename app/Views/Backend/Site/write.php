
<!-- Extend from layout index -->
<?= $this->extend('HaoAdmin\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= route_to('admin.site.manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
                    

            <div class="card-body">
                <div class="col-md-6">
                    <form action="<?= !empty($site)?route_to('admin.site.update',$site['id']):route_to('admin.site.create'); ?>" method="post" class="form-horizontal row" id="form-manage">
                        <?= csrf_field() ?>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('Haoadmin.global.active') ?></label>
                                <div class="col-sm-10">
                                    <select class="form-control select" name="active" style="width: 100%;">
                                        <option <?= (!empty($site) && (int)($site['active'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.global.active') ?></option>
                                        <option <?= (!empty($site) && (int)($site['active'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.global.non_active') ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.site.fields.name')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control <?= session('error.name') ? 'is-invalid' : '' ?>" value="<?= !empty($site['name'])?$site['name']:old('name') ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.name')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.name') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.site.fields.theme')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="theme" class="form-control <?= session('error.theme') ? 'is-invalid' : '' ?>" value="<?= !empty($site['theme'])?$site['theme']:old('theme') ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.theme')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.theme') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.site.fields.description')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="description" class="form-control <?= session('error.description') ? 'is-invalid' : '' ?>" value="<?= !empty($site['description'])?$site['description']:old('description') ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.description')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.description') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input class="hidden-input" type="text" name="domain" value="" placeholder="" autocomplete="off">

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.site.fields.domain')?></label>
                                <div class="col-sm-10">
                                    <ul class="list-group" id="domain-list"></ul>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">http://</span>
                                        </div>
                                        <input type="text"  class="form-control" id="basic-url">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="add-doamin-btn">Add</button>
                                        </div>
                                        <?php if (session('error.domain')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.domain') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <?= lang('Haoadmin.global.save')?>
                                </button>
                            </div>
                        </div>
                        
                        
                    </form>

                </div>
                
            </div>
        </div>      
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script>
    let domainList = [];
    
    $('#add-doamin-btn').click(()=>{
        let domain = $('#basic-url').val().trim();
        domain = domain.replace(/^(https?:\/\/)?/i, ''); 
        //domain = domain.replace(/^www\./i, ''); // remove www
        domain = domain.split('/')[0]; 
        domain = domain.split('?')[0];
        domain = domain.split('#')[0];
        if(domain){
            if(!domainList.includes(domain)){
                domainList.push({
                    'domain':domain,
                    'is_primary':domainList.length>0?0:1
                });
            }
            makeList();
        }
        
    })

    let makeList = function(){
        $('input[name=domain]').val(JSON.stringify(domainList));
        let listHtml = ''
        domainList.forEach((item)=>{
            let html = '<li class="list-group-item">'
                html += '<span class="check"><input class="form-check-input" type="radio" name="main_domain" value="'
                html += item.domain
                html +='" '
                html += item.is_primary>0?"checked":""
                html += '><label class="form-check-label" for="main_domain">Default</span><span>';
                html += item.domain ;
                html += '</span><button type="button" class="btn btn-danger btn-sm float-right"><span class="fa fa-fw fa-trash"></span></button></li>';
            listHtml += html;
        })
        $('#domain-list').html(listHtml);

        $('#domain-list li button').click(function(){
            let delIndex = $(this).parent().index();
            domainList = domainList.filter((item,index)=>{ 
                if(index!==delIndex){
                    return true
                }
            })
            makeList();
        })

        $('#domain-list li .form-check-input').click(function(){
            let delIndex = $(this).parent().parent().index();
            domainList.forEach((item,index)=>{
                if(index===delIndex){
                    item.is_primary = 1
                }else{
                    item.is_primary = 0
                }
            })
            $('input[name=domain]').val(JSON.stringify(domainList));
        })
    }

    let oldDomainList = <?= json_encode($site['domain'] ?? []) ?>;
    if(oldDomainList.length>0){
        oldDomainList.forEach((item)=>{
            domainList.push({
                'domain':item.domain,
                'is_primary':item.is_primary==='1'?1:0
            })
        })
        makeList();
    }

    

</script>
<?= $this->endSection() ?>


