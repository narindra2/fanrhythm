<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
    <a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" target="_blank" style="
        background-color:#{{getSetting('colors.theme_color_code') ? getSetting('colors.theme_color_code') : '32a0f0'}};
        border-top: 10px solid #{{getSetting('colors.theme_color_code') ? getSetting('colors.theme_color_code') : '32a0f0'}};
        border-right: 18px solid #{{getSetting('colors.theme_color_code') ? getSetting('colors.theme_color_code') : '32a0f0'}};
        border-bottom: 10px solid #{{getSetting('colors.theme_color_code') ? getSetting('colors.theme_color_code') : '32a0f0'}};
        border-left: 18px solid #{{getSetting('colors.theme_color_code') ? getSetting('colors.theme_color_code') : '32a0f0'}};
        ">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
