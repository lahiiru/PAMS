<?php
/**
 * Created by PhpStorm.
 * User: Niroshan
 * Date: 8/11/2015
 * Time: 11:10 PM
 */

/*
 * This file is created for  testing perpose
 */

echo '<style>
.badge1 {

   position: absolute;

}
.badge1[data-badge]:after {
   content:attr(data-badge);
   position:absolute;
   top:-10px;
   right:-10px;
   font-size:.7em;
   background:green;
   color:white;
   width:18px;height:18px;
   text-align:center;
   line-height:18px;
   border-radius:50%;
   box-shadow:0 0 1px #333;
}</style>';

echo '
<button class="badge1" data-badge="6">Notification</button>
';

