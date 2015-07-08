<?php namespace Gem\Components\Adapter;

/**
 * Interface AdapterInterface
 *
 * Bu dosya Adapter sınıfının interface dosyasıdır, Adapter sınıfına eklenecek her dosya bu interface sahip olmak
 * zorundadır
 *
 * @package Gem\Components\Adapter
 */
interface AdapterInterface
{
    public function getName ();
    public function boot ();
}