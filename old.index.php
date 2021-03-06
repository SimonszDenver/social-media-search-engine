<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <link rel="icon" type="image/png" href="images/favicon.png" >
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <!-- Aiya's adding -->
        <meta name="description" content="Infoob is World's 1st Social Media Search Engine. You can faster and easier find all social media information such as Facebook, Twitter, Google+, Youtube and other." />
        <title>Social Media Search Engine</title>
        <!-- /Aiya's adding -->
    </head>
    <body>
        <header>

            <ul id="header-nav">
                <li><a href="#">All</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Games</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Arts</a></li>
                <li><a href="#">Kids</a></li>
                <li><a href="#">Shopping</a></li>
            </ul>         

            <div id="small-logo-holder"></div>

        </header>

        <main>

            <div id="logo-holder">
                <img src="images/infooblogo_big.png" alt="Infoob" title="Infoob"/>
            </div>

            <!-- Search box form -->
            <form onsubmit="return executeQuery();" id="cse-search-box-form-id">
                <div>
                    <!-- This is the input search box -->
                    <input type="text" id="cse-search-input-box-id" size="25" autocomplete="off"/>                    
                    <button id="btnSubmit2" type="submit" value=""></button>
                </div>
                <div>
                    <!-- This is the search button -->
                    <input id="btnSubmit1" type="submit" value="Infoob Search"/>
                </div>
            </form>
            <!-- End of search box form -->  
            
<!--            <div id="hidden-search-box">
                <gcse:searchbox-only></gcse:searchbox-only>
            </div>  -->

            <div id="tagline">
                <!--<p>World's 1st Social Media Search Engine <span>enhanced by <a href="http://www.google.com" title="Google"><img src="images/googlelogo_small.png" alt="Google" /></a></span></p>-->
                <p>World's 1st Social Media Search Engine</p>
            </div>

            <script type="text/javascript"
                    src="//www.google.com/cse/brand?form=cse-search-box-form-id&inputbox=cse-search-input-box-id">
            </script>

            <!-- Element code snippet -->
            <script type="text/javascript">
                function executeQuery() {
                    if (status !== "search") {
                        toggleStatus(false);
                    }
                    var input = document.getElementById('cse-search-input-box-id');
                    var element = google.search.cse.element.getElement('searchresults-only0');
                    if (input.value === '') {
                        element.clearAllResults();
                    } else {
                        element.execute(input.value);
                    }
                    return false;
                }
            </script>

            <script>
                (function () {
                    var cx = 'partner-pub-8206357857769646:5919607426'; //017643444788069204610:4gvhea_mvga
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;
                    gcse.src = (document.location.protocol === 'https:' ? 'https:' : 'http:') +
                            '//cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                })();

            </script>

            <div id="search-result">
                <gcse:searchresults-only></gcse:searchresults-only>
            </div>

        </main>
        <footer>
            <ul id="footer-nav">
                <li><a href="advertising/index.php">Advertising</a></li>
                <li><a href="http://infoob.com/blog/">Blog</a></li>
                <li><a href="policies/privacy.php">Privacy</a></li>
                <li><a href="policies/terms-and-conditions.php">Terms</a></li>
            </ul>
            <span id="copyright">Copyright &copy; Infoob 2015</span>
        </footer>

        <script type="text/javascript">

            /*
             *  Holds the status whether it is normal mode or search mode;
             *  Default is normal;
             */
            var status = "normal";

            /*
             *  Holds the search text
             */
            var searchText = document.getElementById("cse-search-input-box-id").value;

            /*
             *  When document is loaded, everything is handled here
             */
            document.body.onload = function () {
                document.getElementById("cse-search-input-box-id").focus();
            };

            /*
             *  Since we can't capture when the search result is actually changed, let's set a timer
             *  to caputer Search Result's dimensions
             */
            setInterval(resizeSearchResult, 500);

            /*
             *  When user start to type something in search box or paste something into the paste box,
             *  here we are looking for changes every 100 miliseconds
             */
            var intervalId = setInterval(function () {
                if (status === "normal") {
                    var currentText = document.getElementById("cse-search-input-box-id").value;
                    if (searchText !== currentText) {
                        searchText = currentText;
                        toggleStatus(false);
                    }
                }
            }, 100);

            /*
             *  In search mode, when user click on Infoob logo, this function handle the event
             *  It basically toggle the mode from search mode to normal mode
             */
            document.getElementById("small-logo-holder").onclick = function () {
                if (status === "search") {
                    /*
                     *  Since we look for any changes every 100 miliseconds, if user suddenly click the logo right 
                     *  after they entered something, there may be a little chance of switching the mode again to search mode
                     *  because search text hasn't been updated yet. So, let's fix it.
                     */
                    searchText = document.getElementById("cse-search-input-box-id").value;
                    toggleStatus(true);
                }
            };

            /*
             *  Toogle the status between Normal & Search
             *  Normal is what user sees when they first come up to the screen
             *  Search is what user sees when they type something in to the search box
             */
            function toggleStatus(bNormal) {
                if (bNormal) {

                    // Set the status to normal mode
                    status = "normal";

                    // Hide some elements which are not part of normal mode
                    document.getElementById("btnSubmit2").style.display = 'none';
                    document.getElementById("search-result").style.display = "none";

                    // Show shome elements which are initially not part of search mode but are of normal mode
                    document.getElementById("header-nav").style.display = "block";
                    document.getElementById("tagline").style.display = "block";

                    document.getElementsByTagName("header")[0].setAttribute("class", "");

                    var logoHolder = document.getElementById("logo-holder");
                    document.querySelector("main").insertBefore(logoHolder, document.getElementById("tagline"));
                    logoHolder.setAttribute("class", "");

                    var searchForm = document.getElementById("cse-search-box-form-id");
                    searchForm.setAttribute("class", "");
                    document.querySelector("main").insertBefore(searchForm, document.getElementById("tagline"));
                    document.getElementById("cse-search-input-box-id").focus();

                } else {

                    // Set the status to search mode
                    status = "search";

                    // Hide some elements which are not part of search mode
                    document.getElementById("header-nav").style.display = "none";
                    document.getElementById("tagline").style.display = "none";

                    // Show shome elements which are initially not part of normal mode but are of search mode
                    document.getElementById("btnSubmit2").style.display = "inline";
                    document.getElementById("search-result").style.display = "block";

                    var header = document.getElementsByTagName("header")[0];
                    header.setAttribute("class", "search-status");

                    var logoHolder = document.getElementById("logo-holder");
                    document.getElementById("small-logo-holder").appendChild(logoHolder);
                    logoHolder.setAttribute("class", "search-status");

                    var searchForm = document.getElementById("cse-search-box-form-id");
                    searchForm.setAttribute("class", "search-status");
                    header.appendChild(searchForm);

                    document.getElementById("cse-search-input-box-id").focus();

                }
            }

            /*
             *  Resize the Search Result Container accroding to the footer height
             */
            function resizeSearchResult() {

                if (status === "search") {
                    searchResult = document.getElementById("search-result");
                    if (searchResult.clientHeight > (document.body.clientHeight - (searchResult.offsetTop + document.querySelector("footer").offsetHeight))) {
                        searchResult.style.paddingBottom = document.querySelector("footer").clientHeight + "px";
                    } else {
                        searchResult.style.paddingBottom = "0px";
                    }
                }

            }
            
        </script>

        <!-- Aiya's adding -->
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-47502617-1', 'auto');
            ga('send', 'pageview');

        </script>        
        <!-- /Aiya's adding -->

    </body>
</html>
