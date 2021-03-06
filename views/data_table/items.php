<table id="wccbef-items-list">
    <thead>
        <tr>
            <?php if (isset($show_id_column) && $show_id_column === true) : ?>
                <?php
                if ('id' == $sort_by) {
                    if ($sort_type == 'ASC') {
                        $sortable_icon = "<i class='dashicons dashicons-arrow-up'></i>";
                    } else {
                        $sortable_icon = "<i class='dashicons dashicons-arrow-down'></i>";
                    }
                } else {
                    $img =  WCCBEF_IMAGES_URL . "/sortable.png";
                    $sortable_icon = "<img src='" . esc_url($img) . "' alt=''>";
                }
                ?>
                <th class="wccbef-td70 <?php echo ($sticky_first_columns == 'yes') ? 'wccbef-td-sticky wccbef-td-sticky-id' : ''; ?>">
                    <input type="checkbox" class="wccbef-check-item-main" title="<?php esc_html_e('Select All', WCCBEF_NAME); ?>">
                    <label data-column-name="id" class="wccbef-sortable-column"><?php esc_html_e('ID', WCCBEF_NAME); ?><span class="wccbef-sortable-column-icon"><?php echo sprintf('%s', $sortable_icon); ?></span></span>
                </th>
            <?php endif; ?>
            <?php if (!empty($next_static_columns)) : ?>
                <?php foreach ($next_static_columns as $static_column) : ?>
                    <?php
                    if ($static_column['field'] == $sort_by) {
                        if ($sort_type == 'ASC') {
                            $sortable_icon = "<i class='dashicons dashicons-arrow-up'></i>";
                        } else {
                            $sortable_icon = "<i class='dashicons dashicons-arrow-down'></i>";
                        }
                    } else {
                        $img =  WCCBEF_IMAGES_URL . "/sortable.png";
                        $sortable_icon = "<img src='" . esc_url($img) . "' alt=''>";
                    }
                    ?>
                    <th data-column-name="<?php echo esc_attr($static_column['field']) ?>" class="wccbef-sortable-column wccbef-td120 <?php echo ($sticky_first_columns == 'yes') ? 'wccbef-td-sticky wccbef-td-sticky-title' : ''; ?>"><?php echo esc_attr($static_column['title']); ?><span class="wccbef-sortable-column-icon"><?php echo sprintf('%s', $sortable_icon); ?></span></th>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($columns)) : ?>
                <?php foreach ($columns as $column_name => $column) : ?>
                    <?php
                    $title = (!empty($columns_title) && isset($columns_title[$column_name])) ? $columns_title[$column_name] : '';
                    $sortable_icon = '';
                    if (isset($column['sortable']) && $column['sortable'] === true) {
                        if ($column_name == $sort_by) {
                            if ($sort_type == 'ASC') {
                                $sortable_icon = "<i class='dashicons dashicons-arrow-up'></i>";
                            } else {
                                $sortable_icon = "<i class='dashicons dashicons-arrow-down'></i>";
                            }
                        } else {
                            $img =  WCCBEF_IMAGES_URL . "/sortable.png";
                            $sortable_icon = "<img src='" . esc_url($img) . "' alt=''>";
                        }
                    }

                    if (!empty($display_full_columns_title)) {
                        $column_title = ($display_full_columns_title == 'no') ? mb_substr($column['title'], 0, 12) . '.' : $column['title'];
                    } else {
                        $column_title = (strlen($column['title']) > 12) ? mb_substr($column['title'], 0, 12) . '.' : $column['title'];
                    }
                    ?>
                    <th data-column-name="<?php echo esc_attr($column_name); ?>" <?php echo (!empty($column['sortable'])) ? 'class="wccbef-sortable-column"' : ''; ?>><?php echo esc_html($column_title); ?><?php echo (!empty($title)) ? "<span class='wccbef-column-title dashicons dashicons-info' title='" . esc_attr($title) . "'></span>" : "" ?> <span class="wccbef-sortable-column-icon"><?php echo sprintf('%s', $sortable_icon); ?></span></th>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($items_loading)) : ?>
            <tr>
                <td colspan="8" class="wccbef-text-alert"><?php esc_html_e('Loading ...', WCCBEF_NAME); ?></td>
            </tr>
        <?php elseif (!empty($items) && count($items) > 0) : ?>
            <?php if (!empty($item_provider && is_object($item_provider))) : ?>
                <?php $variations = !empty($variations) ? $variations : []; ?>
                <?php $item_provider->get_items($items, $variations, $columns); ?>
            <?php endif; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" class="wccbef-text-alert"><?php esc_html_e('No Data Available!', WCCBEF_NAME); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <?php if (isset($show_id_column) && $show_id_column === true) : ?>
                <th <?php echo ($sticky_first_columns == 'yes') ? 'class="wccbef-td-sticky wccbef-td-sticky-id"' : ''; ?>>ID</th>
            <?php endif; ?>
            <?php if (!empty($next_static_columns)) : ?>
                <?php foreach ($next_static_columns as $static_column) : ?>
                    <th <?php echo ($sticky_first_columns == 'yes') ? 'class="wccbef-td-sticky wccbef-td-sticky-title"' : ''; ?>><?php echo esc_html($static_column['title']); ?></th>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($columns)) : ?>
                <?php foreach ($columns as $column) : ?>
                    <th><?php echo (strlen($column['title']) > 12) ? esc_html(mb_substr($column['title'], 0, 12)) . '.' : esc_html($column['title']); ?></th>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>