
<!-- End Google Tag Manager (noscript) -->
<script>
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "; expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];

            while (c.charAt(0) == ' ') {

                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie(cname, value) {
        let c = getCookie(cname);

        if (c == "") {

            setCookie(cname, value, 365);
            c = getCookie(cname);
        }
        return c;

    }

    function isInt(n) {
        return n % 1 === 0;
    }

    checkCookie("pageScroll", 0);

    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }
    let date1 = new Date();
    let uid = (Math.random() + 1).toString(36).substring(7);
    let starthit = 0;
    let hitcount = 0;
    startdatacheck = date1.toLocaleDateString("en-US");
    let startDate = getCookie('startdate');
    let lastDate = setCookie('lastDate', startdatacheck, 365);
    // console.log('old hit', Number(hitcount));
    // console.log('new starthit', starthit);
    // console.log('old startDate', startDate);

    if (startdatacheck != startDate) {
        setCookie('startdate', startdatacheck, 365);

    }
    startDate = getCookie('startdate');
    // console.log('new startDate', startdatacheck);
    // console.log('new lastDate', getCookie('lastDate'));
    if (getCookie('hitcount') != "") {
        hitcount = getCookie('hitcount');
        hitcount = Number(hitcount) + 1;
        setCookie('hitcount', hitcount, 365);
        console.log("old hitcount:", hitcount);

    } else {
        setCookie('hitcount', 1);
        hitcount = 1;
        console.log("new hitcount:", hitcount);
    }
    const fullUrl = window.location.search;
    const urlParams = new URLSearchParams(fullUrl);
    let utm_campaign = '';
    let utm_content = '';
    let utm_source = '';
    let utm_medium = '';
    let utm_id = '';
    let utm_term = '';
    if (urlParams.has('utm_campaign')) {
        utm_campaign = urlParams.get('utm_campaign');

    }
    if (urlParams.has('utm_content')) {
        utm_content = urlParams.get('utm_content');

    }
    if (urlParams.has('utm_source')) {
        utm_source = urlParams.get('utm_source');

    }
    if (urlParams.has('utm_medium')) {
        utm_medium = urlParams.get('utm_medium');

    }
    if (urlParams.has('utm_id')) {
        utm_id = urlParams.get('utm_id');

    }
    if (urlParams.has('utm_term')) {
        utm_term = urlParams.get('utm_term');

    }
    let arg = {};
    arg.hitcount = hitcount;
    arg.start_date = startDate;
    arg.last_date = getCookie('lastDate');
    arg.utm_id = utm_id;
    arg.utm_term = utm_term;
    arg.utm_medium = utm_medium;
    arg.utm_source = utm_source;
    arg.utm_content = utm_content;
    arg.utm_source = utm_source;
    arg.utm_campaign = utm_campaign;
    arg.page_scroll = checkCookie("pageScroll", 0);

    function timeSetup() {
        let docCheck = true;
        for (let i = 0; i < 100; i++) {
            if (docCheck == false) {
                break;
            }
            sleep(1000);
            if (urlParams.has('utm_content')) {
                utm_content = urlParams.get('utm_content');
                fbq('trackCustom', `ads-${utm_content}`, arg);

            }



            if (document.readyState == "complete") {
                docCheck = false;
                for (const [key, value] of Object.entries(arg)) {

                    console.log(`${key}: ${value}`);
                }
                fbq('track', 'ViewContent', arg);
                console.log("trackCustom");
            } else {
                console.log(document.readyState);

            }









        }

    }

    function usertimecount() {



        let date2 = new Date();

        if (date2 < date1) {
            date2.setDate(date2.getDate());
        }

        let timeInMinute = (date2.getMinutes() - date1.getMinutes());


        let eventname = "30-second-Time-on-Page";


        // console.log('timeInMinute ', timeInMinute);

        if (isInt(timeInMinute)) {
            console.log(timeInMinute);
            if (Number(checkCookie("pageviewtime", timeInMinute)) != timeInMinute) {

                setCookie("pageviewtime", timeInMinute, 30);
                eventname = `${timeInMinute}-Minute Time on Page`;
                // console.log(eventname);
                fbq('trackCustom', eventname, arg);
            }

        }
    }
    window.addEventListener("load", (event) => {
        console.log("page is fully loaded");
        timeSetup()
        document.getElementsByTagName('body')[0].onscroll = () => {

            var totalheight = document.body.clientHeight;
            var scrolled = document.documentElement.scrollTop;
            var percentageInPage = (Math.round((scrolled / totalheight) * 100))

            if (isInt(percentageInPage / 10)) {
                usertimecount();
                setCookie("pageScroll", percentageInPage, 365);
                arg.page_scroll = checkCookie("pageScroll", percentageInPage);
                let eventname = `PageView${percentageInPage}`;
                fbq('trackCustom', eventname, arg);

            }


        };
    });
</script>
