<?php

/*
 * This file is part of the phpems/phpems.
 *
 * (c) oiuv <i@oiuv.cn>
 *
 * This source file is subject to the MIT license that is bundled.
 */

class action extends app
{
    public function display()
    {
        $action = $this->ev->url(3);
        if (!method_exists($this, $action)) {
            $action = 'index';
        }
        $this->$action();
        exit;
    }

    private function getajaxbasiclist()
    {
        $subjectid = $this->ev->get('subjectid');
        $current = $this->ev->get('current');
        $basics = $this->basic->getBasicsByArgs([['AND', 'basicsubjectid = :basicsubjectid', 'basicsubjectid', $subjectid]]);
        if ($basics) {
            foreach ($basics as $basic) {
                if ($current == $basic['basicid']) {
                    echo "<option value=\"{$basic['basicid']}\" selected>{$basic['basic']}</option>";
                } else {
                    echo "<option value=\"{$basic['basicid']}\">{$basic['basic']}</option>";
                }
            }
        } else {
            echo '<option value="">请先选择科目</option>';
        }
    }

    private function index()
    {
        $this->tpl->display('index');
    }
}
