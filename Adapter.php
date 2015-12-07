<?php

interface Queue {

  function push();

  function pull();

  function confirm();

  function listen();

  function close();

}

class Adapter implements Queue {



}
