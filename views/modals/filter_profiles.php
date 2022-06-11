<div class="wccbef-modal" id="wccbef-modal-filter-profiles">
    <div class="wccbef-modal-container">
        <div class="wccbef-modal-box wccbef-modal-box-lg">
            <div class="wccbef-modal-content">
                <div class="wccbef-modal-title">
                    <h2><?php esc_html_e('Filter Profiles', WCCBEF_NAME); ?></h2>
                    <button type="button" class="wccbef-modal-close" data-toggle="modal-close">
                        <i class="lni lni-close"></i>
                    </button>
                </div>
                <div class="wccbef-modal-body">
                    <div class="wccbef-wrap">
                        <div class="wccbef-filter-profiles-items wccbef-pb30">
                            <div class="wccbef-table-border-radius">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><?php esc_html_e('Profile Name', WCCBEF_NAME); ?></th>
                                            <th><?php esc_html_e('Date Modified', WCCBEF_NAME); ?></th>
                                            <th><?php esc_html_e('Use Always', WCCBEF_NAME); ?></th>
                                            <th><?php esc_html_e('Actions', WCCBEF_NAME); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($filters_preset)) : ?>
                                            <?php foreach ($filters_preset as $filter_item) : ?>
                                                <?php include "filter_profile_item.php"; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>