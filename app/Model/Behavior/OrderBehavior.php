<?php

class OrderBehavior extends ModelBehavior {

    

    public function moveUp(Model $Model, $id) {
        $model = $Model->name;
        $options['conditions'] = array(
            $model . '.id' => $id
        );
        $item = $Model->find('first', $options);
        $order = $item[$model]['order'];
        $options['conditions'] = array(
            $model . '.order <' => $order
        );
        $options['order'] = $model . '.order DESC';
        $item2 = $Model->find('first', $options);
        if (empty($item2)) {
            return;
        }
        $item[$model]['order'] = $item2[$model]['order'];
        $item2[$model]['order'] = $order;
        $Model->save($item);
        $Model->save($item2);
    }

    public function moveDown(Model $Model, $id) {
        $model = $Model->name;
        $options['conditions'] = array(
            $model . '.id' => $id
        );
        $item = $Model->find('first', $options);
        $order = $item[$model]['order'];
        $options['conditions'] = array(
            $model . '.order >' => $order
        );
        $options['order'] = $model . '.order ASC';
        $item2 = $Model->find('first', $options);
        if (empty($item2)) {
            return;
        }
        $item[$model]['order'] = $item2[$model]['order'];
        $item2[$model]['order'] = $order;
        $Model->save($item);
        $Model->save($item2);
    }

    public function getLastOrder(Model $Model) {
        $model = $Model->name;
        $options['order'] = $model . '.order DESC';
        $item = $Model->find('first', $options);
        if (!empty($item)) {
            return $item[$model]['order'];
        }
        return 0;
    }

}

?>
