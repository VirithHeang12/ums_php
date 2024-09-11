<?php

interface CRUDable
{
    public function create(): void;
    public function read(): array;
    public function update(): void;
    public function delete(): void;
}