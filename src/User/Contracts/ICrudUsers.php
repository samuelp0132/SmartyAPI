<?php

namespace User\Contracts;

interface ICrudUsers {

    public function create();
    public function delete();
    public function update();
    public function read();
    public function read_by_id();

}
