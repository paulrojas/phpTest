<?php
/**
 * Created by PhpStorm.
 * User: paulrojas
 * Date: 9/20/15
 * Time: 18:40
 */

class GetPrevNext {
    var $elements, $current_page, $length, $position;

    public function findPrevNext($el, $current_page) {
        $position = strpos($el, ','.$current_page.',');
        $type=0;
        if ($position===false) {
            $position = strpos($el, $current_page.',');
            $type=1;
            if ($position===false) {
                $position = strpos($el, ','.$current_page);
                $type=2;
                if ($position===false) {
                    echo "The page you're looking for was not found.";
                    return;
                }
            }
        }

        $this->elements = $el;
        $this->current_page = $current_page;
        $this->position = $position;
        $this->length = strlen($el);
        $prevpage=null;
        $nextpage=null;
        if ($type==0) {
            $prevpage = $this->prevPage();
            $nextpage = $this->nextPage();
        }
        if ($type==1) {
            $nextpage = $this->nextPage();
        }
        if ($type==2) {
            $prevpage = $this->prevPage();
        }
        return array('prev' => $prevpage, 'next' => $nextpage);
    }

    function prevPage() {
        $p1 = $this->position - 1 - $this->length;
        $prevposition = strrpos($this->elements, ',', $p1);
        if ($prevposition===false) $prevposition = -1;
        $prevpage = substr($this->elements, $prevposition+1, $this->position - $prevposition - 1);
        return $prevpage;
    }

    function nextPage() {
        $p2 = $this->position + strlen($this->current_page) + 1 + ($this->position ? 1: 0);
        $nextposition = strpos($this->elements, ',', $p2);
        if ($nextposition===false) $nextposition = $this->length;
        $nextpage = substr($this->elements, $p2, $nextposition - $p2);
        return $nextpage;
    }
}

$elements = $_POST['elements'];
$page=$_POST['page'];
$obj = new GetPrevNext();
$r = $obj->findPrevNext($elements, $page);
echo print_r($r);