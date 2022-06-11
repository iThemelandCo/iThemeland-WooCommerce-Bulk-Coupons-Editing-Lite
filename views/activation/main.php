<?php $industries = wccbef\classes\helpers\Industry_Helper::get_industries(); ?>

<div id="wccbef-body">
    <div class="wccbef-dashboard-body">
        <div id="wccbef-activation">
            <?php if (isset($is_active) && $is_active === true && $activation_skipped !== true) : ?>
                <div class="wccbef-wrap">
                    <div class="wccbef-tab-middle-content">
                        <div id="wccbef-activation-info">
                            <strong><?php esc_html_e("Congratulations, Your plugin is activated successfully. Let's Go!", WCCBEF_NAME) ?></strong>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="wccbef-wrap wccbef-activation-form">
                    <div class="wccbef-tab-middle-content">
                        <?php if (!empty($flush_message) && is_array($flush_message)) : ?>
                            <div class="wccbef-alert <?php echo ($flush_message['message'] == "Success !") ? "wccbef-alert-success" : "wccbef-alert-danger"; ?>">
                                <span><?php echo sanitize_text_field($flush_message['message']); ?></span>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="wccbef-activation-form">
                            <h3 class="wccbef-activation-top-alert">Fill the below form to get the latest updates' news and <strong style="text-decoration: underline;">Special Offers(Discount)</strong>, Otherwise, Skip it!</h3>
                            <input type="hidden" name="action" value="wccbef_activation_plugin">
                            <div class="wccbef-activation-field">
                                <label for="wccbef-activation-email"><?php esc_html_e('Email', WCCBEF_NAME); ?> </label>
                                <input type="email" name="email" placeholder="Email ..." id="wccbef-activation-email">
                            </div>
                            <div class="wccbef-activation-field">
                                <label for="wccbef-activation-industry"><?php esc_html_e('What is your industry?', WCCBEF_NAME); ?> </label>
                                <select name="industry" id="wccbef-activation-industry">
                                    <option value=""><?php esc_html_e('Select', WCCBEF_NAME); ?></option>
                                    <?php
                                    if (!empty($industries)) :
                                        foreach ($industries as $industry_key => $industry_label) :
                                    ?>
                                            <option value="<?php echo esc_attr($industry_key); ?>"><?php echo esc_attr($industry_label); ?></option>
                                    <?php
                                        endforeach;
                                    endif
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="activation_type" id="wccbef-activation-type" value="">
                            <button type="button" id="wccbef-activation-activate" class="wccbef-button wccbef-button-lg wccbef-button-blue" value="1"><?php esc_html_e('Activate', WCCBEF_NAME); ?></button>
                            <button type="button" id="wccbef-activation-skip" class="wccbef-button wccbef-button-lg wccbef-button-gray" style="float: left;" value="skip"><?php esc_html_e('Skip', WCCBEF_NAME); ?></button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>