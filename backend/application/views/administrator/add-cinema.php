<?php
#add-blog.php
?>

<div class="tz-2 tz-2-admin">

    <div class="tz-2-com tz-2-main">

        <h4>Add Cinema</h4>

        <div style="padding:10px;">
            <?php echo validation_errors(); ?>
            <?php if (isset($upload_error))
                echo $upload_error; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
        </div>

        <div style="padding:10px;">
            <?php echo validation_errors() ?>
        </div>
        <!-- Dropdown Structure -->
        <div class="split-row">
            <div class="col-md-12">
                <div class="box-inn-sp ad-mar-to-min">
                    <div class="tab-inn ad-tab-inn">
                        <div class="tz2-form-pay tz2-form-com ad-noto-text">

                            <form action="<?php echo base_url() ?>cinema/add_cinema" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="do" value="addRow" />

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" class="validate" name="c_title" id="c_title"
                                            autocomplete="off" value="<?php echo set_value('c_title'); ?>" required>
                                        <label>Name of the Cinema</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" class="validate" name="c_url" id="c_url" autocomplete="off"
                                            value="<?php echo set_value('c_url'); ?>" required>
                                        <label>Website Link</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" class="validate" name="c_img" id="c_img" autocomplete="off"
                                            value="<?php echo set_value('c_img'); ?>" required>
                                        <label>Image URL</label>
                                    </div>
                                </div>
                                <!-- working file upload -->
                                <!-- <div class="row tz-file-upload">
                                    <div class="file-field input-field">
                                        <div class="tz-up-btn"> <span>Upload Theatre Image</span>
                                            <input type="file" name="fileToUpload">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" name="files" accept="image/*" type="text"
                                                placeholder="note: not more than 2MB" style="height:5rem;">
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row">

                                    <div class="input-field col s12">
                                        <input type="submit" name="submit_34" value="SUBMIT"
                                            class="waves-effect waves-light full-btn">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>