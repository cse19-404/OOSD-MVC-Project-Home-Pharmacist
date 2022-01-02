<?php
interface Strategy{
    public function orderAction($preId, $change='', $handler);
}