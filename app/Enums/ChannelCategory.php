<?php

namespace App\Enums;

enum ChannelCategory: string
{
    case NEWS = 'Noticias';
    case SPORTS = 'Deportes';
    case MOVIES = 'Peliculas';
    case MUSIC = 'Música';
    case KIDS = 'Niños';
    case DOCUMENTARY = 'Documental';
    case EDUCATION = 'Educación';
    case ENTERTAINMENT = 'Entretenimiento';
    case RELIGION = 'Religión';
    case LIFESTYLE = 'Estilo de vida';

    public function label(): string
    {
        return match ($this) {
            self::NEWS => __('News'),
            self::SPORTS => __('Sports'),
            self::MOVIES => __('Movies'),
            self::MUSIC => __('Music'),
            self::KIDS => __('Kids'),
            self::DOCUMENTARY => __('Documentary'),
            self::EDUCATION => __('Education'),
            self::ENTERTAINMENT => __('Entertainment'),
            self::RELIGION => __('Religion'),
            self::LIFESTYLE => __('Lifestyle'),
        };
    }
}
