<?php

function InputElement($type, $id)
{
    if ($type == 'checkbox') {
        return '<label class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="checkbox" onchange="checkboxThis(this)" value="' . $id . '">
                </label>';
    }
}

function FormatDate($date)
{
    $time = strtotime($date);
    return date('d/m/Y', $time);
}

function FormatStatus($value, $type = null)
{
    if ($type) {
        return '<span class="badge bg-' . $type . '">' . $value . '</span>';
    } else {
        if (strtolower($value) === 'success' || strtolower($value) === 'done' || strtolower($value) === 'finish' || strtolower($value) === 'active') {
            $type = 'success';
        } else if (strtolower($value) === 'cancel' || strtolower($value) === 'cancelled' || strtolower($value) === 'stop' || strtolower($value) === 'inactive') {
            $type = 'danger';
        } else if (strtolower($value) === 'progress' || strtolower($value) === 'in progress' || strtolower($value) === 'process' || strtolower($value) === 'wait') {
            $type = 'warning';
        } else if (strtolower($value) === 'info' || strtolower($value) === 'annoucement' || strtolower($value) === 'attention') {
            $type = 'info';
        } else {
            $type = 'secondary';
        }
        return '<span class="badge bg-' . $type . '">' . $value . '</span>';
    }
}
