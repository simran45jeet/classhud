<div class="table-responsive logs">
    <table class="table table-sm" width="100%" class="display" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="headings thead-dark">
                <th><?php echo $this->lang->line('sr'); ?></th>
                <th class="column-title myth"><?php echo $this->lang->line('logs'); ?></th>
                <th class="column-title myth"><?php echo $this->lang->line('ip_address'); ?></th>
                <th class="column-title myth"><?php echo $this->lang->line('created_on'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=$page + 1; if(!empty($logs)){ foreach($logs as $record): ?>
            <tr>
                <td class="text-left"><?=$i?></td>
                <td class="text-left"><?php echo $record['text']; ?></td>
                <td class="text-left"><?php echo ($record['ip_address']) ? $record['ip_address'] : 'NA'; ?></td>
                <td class="text-left"><?php echo date(DEFAULT_DATETIME_FORMAT, strtotime($record['created_at'])); ?></td>
            </tr>
            <?php $i++; endforeach;
            }else{?>
            <tr>
                <td colspan="4" class="text-center">
                    <?php 
                        echo $this->lang->line('no_records');
                    ?>
                </td>
            </tr>
            <?php }  ?>
        </tbody>
    </table>
</div>
<div class="table-responsive">
<?=$links?>
</div>