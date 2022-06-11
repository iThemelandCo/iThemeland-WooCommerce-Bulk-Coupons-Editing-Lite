<div class="wccbef-modal" id="wccbef-modal-numeric-calculator">
    <div class="wccbef-modal-container">
        <div class="wccbef-modal-box wccbef-modal-box-sm">
            <div class="wccbef-modal-content">
                <div class="wccbef-modal-title">
                    <h2><?php esc_html_e('Calculator', WCCBEF_NAME); ?> - <span id="wccbef-modal-numeric-calculator-item-title" class="wccbef-modal-product-title"></span></h2>
                    <button type="button" class="wccbef-modal-close" data-toggle="modal-close">
                        <i class="lni lni-close"></i>
                    </button>
                </div>
                <div class="wccbef-modal-body">
                    <div class="wccbef-wrap">
                        <select id="wccbef-numeric-calculator-operator" title="<?php esc_html_e('Select Operator', WCCBEF_NAME); ?>">
                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="replace"><?php esc_html_e('replace', WCCBEF_NAME); ?></option>
                        </select>
                        <input type="number" placeholder="<?php esc_html_e('Enter Value ...', WCCBEF_NAME); ?>" id="wccbef-numeric-calculator-value" title="<?php esc_html_e('Value', WCCBEF_NAME); ?>">
                    </div>
                </div>
                <div class="wccbef-modal-footer">
                    <button type="button" data-item-id="" data-field="" data-field-type="" data-toggle="modal-close" class="wccbef-button wccbef-button-blue wccbef-edit-action-numeric-calculator">
                        <?php esc_html_e('Apply Changes', WCCBEF_NAME); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>