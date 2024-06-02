<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NivekPC</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="fix.css">
  <link rel="stylesheet" href="style.css">
  <?php include 'include/navbar.php'; ?>
</head>
<body>
  <section class="section-services">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-md-10 col-lg-8">
          <div class="header-section">
            <h2 class="title">Fix</h2>
            <p class="description">Problem PC? We’ll solve it. We’re who you call when your desktop runs slow and your programs stop working. From corrupted hard drives to infected machines, Computer Repair is your personal army of tech-savvy geeks.</p>
          </div>
        </div>
      </div>
      <ul class="tabs">
        <li class="active" data-id="0">Computer Boot Issues</li>
        <li data-id="1">Boot Problems</li>
        <li data-id="2">PC Freeze & Restart</li>
        <li data-id="3">Screen Display Failure</li>
      </ul>
      <div class="contents">
        <div class="box show" data-content="0">
          <img src="https://i.pinimg.com/564x/c6/6a/09/c66a095577e42ba9e3157b24cdde94ce.jpg" alt="">
          <div>
            <h3>Computer Won’t Turn On</h3>
            <p>Most scariest thing that can happen to your MAC or Windows computer is failure to turn on at all. You press the little power button and nothing happens. No beeps, clicks, clunks or whirs. Light on the monitor is on, but your computer is totally dead. When your computer refuses to turn on, it can be quite alarming. But before you panic, take a moment to check the power source and connections. Sometimes, the problem lies in something as simple as a loose power cable or a faulty outlet. Ensure that all power cables, including those from the computer to the wall socket or power strip, are securely plugged in at both ends. If your computer still won’t turn on, it’s time to call in the professionals.</p>
          </div>
        </div>
        <div class="box hide" data-content="1">
          <img src="https://www.partitionwizard.com/images/uploads/articles/2019/04/your-pc-ran-into-problem/your-pc-ran-into-problem-1.png" alt="">
          <div>
            <h3>Computer Fails to Start</h3>
            <p>This can happen suddenly and without any visible cause. Sometimes your computer begins to load but after some time stops responding during start up process. This problem can be caused by many factors. Your computer can try to load windows from removable media. First of all check and remove any CD’s, DVD’s, USB flash drives, memory cards. Remove any digital cameras or external hard drives. Try to restart your computer. If it fails again something else is causing the problem. If your desktop display and error during start up, this is probably caused by hardware configuration problem. Your motherboard, CPU, memory or graphic card may develop a problem.</p>
          </div>
        </div>
        <div class="box hide" data-content="2">
          <img src="https://www.drivereasy.com/wp-content/uploads/2019/09/freeze.jpg" alt="">
          <div>
            <h3>Computer Freezes and Restarts</h3>
            <p>It can be two kind of problems causing computer to freeze and restart. First and most probable one is software problem (Window or Mac). Viruses, Trojans, rogues and other adware can cause system instability. When systems detects a problem it restarts to prevent future damage. These problems can be solved by cleaning unwanted programs and spyware, upgrading drivers or reinstalling operating system. Our computer engineers can test is it software problem and repair your computer ant you home or office straight away. Second and more serious – hardware problem. Computer overheating is most probable cause for computer freezing and restarting.</p>
          </div>
        </div>
        <div class="box hide" data-content="3">
          <img src="https://www.ytechb.com/wp-content/uploads/2022/03/No-Signal-Message-on-Monitor.webp" alt="">
          <div>
            <h3>Screen Doesn’t Show Anything</h3>
            <p>You turn on desktop computer. You can heard it starting to work and windows start to load, but your screen doesn’t show anything or “no signal found”. This can happen for many reasons. If you moved your computer recently, please check all your cables. They can be loose slightly and did not send proper signal. If cables are all ok, you should try to connect Screen to another computer. Maybe your monitor is faulty? Sometimes screen shows nothing because of faulty graphic card or other hardware. If steps mentioned above did not solve your problem, you should contact professional computer repair technician.</p>
          </div>
        </div>
        <a href="contact.html" class="btn btn-primary btn-lg">Contact Us</a>
      </div>
    </div>
  </section>
  <?php include 'include/footer.php'; ?>
  
    <script src="script.js"></SCript>

  <script>
    'use strict';
    const tabs = document.querySelectorAll('.tabs li');
    const contents = document.querySelectorAll('.box');
    let id = 0;
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        tabs[id].classList.remove('active');
        tab.classList.add('active');
        id = parseInt(tab.dataset.id);
        contents.forEach(function (box) {
          box.classList.remove('show');
          box.classList.add('hide');
          if (box.dataset.content == id) {
            box.classList.remove('hide');
            box.classList.add('show');
          }
        });
      });
    });
  </script>
</body>
</html>
