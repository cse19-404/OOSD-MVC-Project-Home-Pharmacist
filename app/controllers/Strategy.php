<?php
interface Strategy{
    public function orderAction($preId, $handler, $change='');
}