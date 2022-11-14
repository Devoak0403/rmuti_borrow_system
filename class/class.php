    <?php

    function calculateExpiry($reg_date)
    {
        $next_tenday = strtotime('+10 day', $reg_date);
        $feb_days = ((($next_tenday % 4) == 0) && ((($next_tenday % 100) != 0) || (($next_tenday % 400) == 0))) ? 29 : 28;
        return strtotime($feb_days.' February '.$next_tenday);
    }

    ?>