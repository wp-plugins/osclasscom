<?php

/**
 * Adds Osclasscom_Widget widget.
 */
class Osclasscom_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'osclasscom_widget', // Base ID
            __('Jobs from Osclass.com', 'osclasscom'), // Name
            array( 'description' => __( 'Display your job offers', 'osclasscom' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        $rss = fetch_feed(get_option('osclasscom').'/search?sFeed=rss');

        if ( !$rss->get_item_quantity() ) {
            echo '<ul><li>' . __( 'No vacancies available', 'osclasscom' ) . '</li></ul>';
            echo '<p class="widget-osclasscom-poweredby" style="text-align: right;"><small><a href="http://osclass.com/">' . __('Powered by osclass.com', 'osclasscom') . '</a></small></p>';
            $rss->__destruct();
            unset($rss);
            return;
        }

        echo '<ul>';
        foreach ( $rss->get_items(0, $instance['number']) as $item ) {
            $trimed_content = '';
            if(function_exists('wp_trim_words')) {
                $trimed_content = wp_trim_words( $item->get_description(), 25, '...' );
            } else {
                $trimed_content = osclasscom_get_the_excerpt($item->get_description(), 25, '[...]');
            }
            $title  = '<h5 class="widget-title widget-title-osclasscom">';
            $title .= '<a class="widget-title-link" href="' . $item->get_link() . '" title="' . $item->get_title() . '">' . $item->get_title() . '</a>';
            $title .= '</h5>';
            $description = '<p><strong>' . date_i18n( get_option( 'date_format' ), $item->get_date( 'U' ) ) . '</strong> '. $trimed_content.'</p>';
            echo '<li>' . $title . $description . '</li>';
        }
        echo '</ul>';

        echo '<p class="widget-osclasscom-viewall" style="text-align: center;"><a href="' . get_option('osclasscom') . '">' . __('View all offers', 'osclasscom') . "</a></p>";
        echo '<p class="widget-osclasscom-poweredby" style="text-align: right;"><small><a href="http://osclass.com/" target="_blank">' . __('Powered by osclass.com', 'osclasscom') . '</a></small></p>';
        echo $args['after_widget'];

        $rss->__destruct();
        unset($rss);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Jobs', 'osclasscom' );
        }

        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'osclasscom' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of vacancies to show:', 'osclasscom' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        if ( ! absint( $new_instance['number'] ) == 0 ) {
            $instance['number'] = absint( $new_instance['number'] );
        } else {
            $instance['number'] = 5;
        }

        return $instance;
    }
}

// class Osclasscom_Widget