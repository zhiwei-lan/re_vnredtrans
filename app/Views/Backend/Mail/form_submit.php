<table width="100%" cellpadding="0" cellspacing="0"
       style="background:#f5f6f8;padding:30px 0;font-family:Arial,Helvetica,sans-serif;">
    <tr>
        <td align="center">

            <!-- 主卡片 -->
            <table width="620" cellpadding="0" cellspacing="0"
                   style="background:#ffffff;border:1px solid #e5e7eb;border-radius:6px;">

                <!-- 标题 -->
                <tr>
                    <td style="padding:18px 28px;border-bottom:1px solid #eeeeee;">
                        <strong style="font-size:16px;color:#111827;">
                            📩 <?= $site_name.':'.$success_message ?>
                        </strong>
                    </td>
                </tr>

                <!-- 表单内容 -->
                <tr>
                    <td style="padding:20px 28px;">

                        <table width="100%" cellpadding="0" cellspacing="0">

                            <?php foreach ($data as $field): ?>
                                <?php if (empty($field['value'])) continue; ?>
                                <?php if ($field['label']=='&nbsp;') continue; ?>
                                <tr>
                                    <!-- Label -->
                                    <td width="160"
                                        style="padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;">
                                        <?= esc($field['label']) ?>
                                    </td>

                                    <!-- Value -->
                                    <td style="padding:10px 0;color:#111827;font-size:14px;">

                                        <?php if (is_array($field['value'])): ?>

                                            <?php foreach ($field['value'] as $file): ?>
                                                <a target="_blank" href="<?= site_url("/download/{$file['media_id']}?token={$file['token']}") ?>"
                                                   style="color:#2563eb;text-decoration:none;">
                                                    <?= esc($file['origin']) ?>
                                                </a><br>
                                            <?php endforeach; ?>

                                        <?php else: ?>

                                            <?= nl2br(esc($field['value'])) ?>

                                        <?php endif; ?>

                                    </td>
                                </tr>

                                <!-- 分割线 -->
                                <tr>
                                    <td colspan="2" style="border-bottom:1px solid #f1f1f1;"></td>
                                </tr>

                            <?php endforeach; ?>

                        </table>

                    </td>
                </tr>

                <!-- 底部信息 -->
                <tr>
                    <td style="background:#fafafa;padding:14px 28px;font-size:12px;color:#6b7280;">
                        IP: <?= esc($submit['ip']) ?><br>
                        USER AGENT: <?= esc($submit['user_agent']) ?><br>
                        DATE: <?= esc($submit['created_at']) ?>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>
