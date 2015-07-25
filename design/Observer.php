<?php
/**
 * design pattern: Observer
 * 观察者模式，当一个对象的状态发生改变是，以来它的对象全部会收到通知，并且自动更新
 *
 * 场景：
 * 一个时间发生后，要执行一连串更新操作。传统的编程方式，就是在事件的代码之后直接加入处理逻辑。
 * 当更新的逻辑增多以后，代码会变得难以维护，这种方式是耦合的，侵入式的，增加新的逻辑需要修改时间主体的代码
 *
 * 观察者模式实现了低耦合，非侵入式的通知与更新机制
 */


/**
 * 事件产生器
 */
abstract class EventGernerate{
    /**
     * @var array 观察者列表
     */
    private $observers = array();
    /**
     * @return Observer 增加一个观察者
     * @see Observer
     */
    function addObserver(Observer $observer){
        $this->observers[] = $observer;
    }
    /**
     * 通知观察者
     * 遍历EventGenaerate::observer
     */
    function notify(){
        foreach($this->observers as $observer){
            $observer->update();
        }
    }
}

/**
 * 观察者接口
 */
interface Observer{
    function update($event_info=null);
}

/**
 * 事件
 */
class Event extends EventGernerate{
    //触发事件
    public function trigger(){
        echo 'Event <br />';
        //触发事件后，通知观察者
        $this->notify();
    }
}

/**
 * 观察者1
 */
class Observer1 implements Observer{
    function update($event_info = null){
        echo '逻辑1';
    }
}
/**
 * 观察者2
 */
class Observer2 implements Observer{
    function update($event_info = null){
        echo '逻辑2';
    }
}


/***
 * 观察者模式的时间调用
 */

//观察者1对象
$observer1 = new Observer1();
//观察者2对象
$observer2 = new Observer2();

//事件对象
$event = new Event();
//把观察者1对象，观察者对象2加入到事件中
$event->addObserver($observer1);
$event->addObserver($observer2);

//触发事件
$event->trigger();
