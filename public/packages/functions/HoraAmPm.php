<?php

function HoraAmPm($hora)
{
    $h = $hora;

    if ($h != "") {
        $h = explode(':', $h);
        $h[0] = intval($h[0]);
        $h[1] = intval($h[1]);
        $ampm = 'a.m.'; // a.m. || p.m.
        if ($h[0] > 12) {
            $ampm = 'p.m.';
            $h[0] = $h[0] - 12;
        } elseif ($h[0] == 12) {
            $ampm = 'p.m.';
        } elseif ($h[0] == 0) {
            $h[0] = 12;
        }
        //agregar 0 a los minutos si son menos de 10
        if ($h[1] < 10) {
            $h[1] = '0' . $h[1];
        }
        return $h[0] . ':' . $h[1] . ' ' . $ampm;
    } else {
        return "";
    }
}