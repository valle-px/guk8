<?php

/**
 * Registry — CPT "dj", meta keys, metaboxes, admin columns
 *
 * CPT slug = "dj", rewrite = "dj", archive = "djs", rest_base = "djs"
 * Taxonomy: sound (GLOBAL BRIDGE via apollo-core, shared with event)
 *
 * @package Apollo\DJs
 */

declare(strict_types=1);

namespace Apollo\DJs;

if (! defined('ABSPATH')) {
    exit;
}

class Registry
{

    public function __construct()
    {
        add_action('init', array($this, 'register_cpt'), 5);
        add_filter('apollo_core_register_meta', array($this, 'register_meta'));
        // Metaboxes delegados para Admin\Metabox (PSR-4)
        add_filter('manage_' . APOLLO_DJ_CPT . '_posts_columns', array($this, 'admin_columns'));
        add_action('manage_' . APOLLO_DJ_CPT . '_posts_custom_column', array($this, 'admin_column_content'), 10, 2);
    }

    /**
     * Registra CPT "dj" — fallback se apollo-core não registrou
     */
    public function register_cpt(): void
    {
        if (post_type_exists(APOLLO_DJ_CPT)) {
            $this->register_taxonomy_fallback();
            return;
        }

        $labels = array(
            'name'               => __('DJs', 'apollo-djs'),
            'singular_name'      => __('DJ', 'apollo-djs'),
            'add_new'            => __('Novo DJ', 'apollo-djs'),
            'add_new_item'       => __('Adicionar Novo DJ', 'apollo-djs'),
            'edit_item'          => __('Editar DJ', 'apollo-djs'),
            'new_item'           => __('Novo DJ', 'apollo-djs'),
            'view_item'          => __('Ver DJ', 'apollo-djs'),
            'search_items'       => __('Buscar DJs', 'apollo-djs'),
            'not_found'          => __('Nenhum DJ encontrado', 'apollo-djs'),
            'not_found_in_trash' => __('Nenhum DJ na lixeira', 'apollo-djs'),
        );

        register_post_type(
            APOLLO_DJ_CPT,
            array(
                'labels'              => $labels,
                'public'              => true,
                'has_archive'         => 'djs',
                'rewrite'             => array(
                    'slug'       => 'dj',
                    'with_front' => false,
                ),
                'rest_base'           => 'djs',
                'show_in_rest'        => true,
                'supports'            => array('title', 'editor', 'thumbnail', 'author'),
                'menu_icon'           => 'dashicons-format-audio',
                'menu_position'       => 7,
                'taxonomies'          => array(APOLLO_DJ_TAX_SOUND),
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
                'show_in_admin_bar'   => true,
                'exclude_from_search' => false,
            )
        );

        $this->register_taxonomy_fallback();
    }

    /**
     * Fallback: registra taxonomy sound se apollo-core/apollo-events não registraram
     */
    private function register_taxonomy_fallback(): void
    {
        if (! taxonomy_exists(APOLLO_DJ_TAX_SOUND)) {
            register_taxonomy(
                APOLLO_DJ_TAX_SOUND,
                array(APOLLO_DJ_CPT, 'event'),
                array(
                    'labels'       => array(
                        'name'          => 'Gêneros Musicais',
                        'singular_name' => 'Gênero Musical',
                    ),
                    'hierarchical' => true,
                    'public'       => true,
                    'show_in_rest' => true,
                    'rewrite'      => array('slug' => 'som'),
                )
            );
        }
    }

    /**
     * Meta keys via apollo-core — conforme apollo-registry.json
     */
    public function register_meta(array $meta_config): array
    {
        $meta_config['dj'] = array(
            '_dj_image'      => array(
                'type'     => 'integer',
                'sanitize' => 'absint',
            ),
            '_dj_banner'     => array(
                'type'     => 'integer',
                'sanitize' => 'absint',
            ),
            '_dj_website'    => array(
                'type'     => 'string',
                'sanitize' => 'esc_url_raw',
            ),
            '_dj_instagram'  => array(
                'type'     => 'string',
                'sanitize' => 'sanitize_text_field',
            ),
            '_dj_soundcloud' => array(
                'type'     => 'string',
                'sanitize' => 'esc_url_raw',
            ),
            '_dj_spotify'    => array(
                'type'     => 'string',
                'sanitize' => 'esc_url_raw',
            ),
            '_dj_youtube'    => array(
                'type'     => 'string',
                'sanitize' => 'esc_url_raw',
            ),
            '_dj_mixcloud'   => array(
                'type'     => 'string',
                'sanitize' => 'esc_url_raw',
            ),
            '_dj_user_id'    => array(
                'type'     => 'integer',
                'sanitize' => 'absint',
            ),
            '_dj_verified'   => array(
                'type'     => 'boolean',
                'sanitize' => 'rest_sanitize_boolean',
            ),
            '_dj_bio_short'  => array(
                'type'     => 'string',
                'sanitize' => 'sanitize_textarea_field',
            ),
        );

        return $meta_config;
    }

    /**
     * Colunas admin
     */
    public function admin_columns(array $columns): array
    {
        $new = array();
        foreach ($columns as $key => $label) {
            $new[$key] = $label;
            if ('title' === $key) {
                $new['dj_verified'] = __('Verificado', 'apollo-djs');
                $new['dj_sounds']   = __('Gêneros', 'apollo-djs');
                $new['dj_events']   = __('Eventos', 'apollo-djs');
            }
        }
        return $new;
    }

    /**
     * Conteúdo das colunas admin
     */
    public function admin_column_content(string $column, int $post_id): void
    {
        switch ($column) {
            case 'dj_verified':
                echo apollo_dj_is_verified($post_id) ? '✅' : '—';
                break;

            case 'dj_sounds':
                $sounds = apollo_dj_get_sounds($post_id);
                echo esc_html(implode(', ', $sounds) ?: '—');
                break;

            case 'dj_events':
                $count = apollo_dj_count_upcoming_events($post_id);
                echo esc_html($count);
                break;
        }
    }
}
