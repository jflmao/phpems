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

    private function clear()
    {
        $this->session->clearOutTimeUser();
        $this->exam->clearOutTimeExamSession();
        $message = [
            'statusCode' => 200,
            'message' => '操作成功',
            'navTabId' => '',
            'rel' => '',
        ];
        exit(json_encode($message));
    }

    private function index()
    {
        $this->tpl->display('tools');
    }
}
