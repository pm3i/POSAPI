<?php

/* heyAutoDemoBundle:Users:account.html.twig */
class __TwigTemplate_1c0ba67a0cdc7fae680943fbc558f0216e7cc01ecffd7aac14b7e6e0c9a44d82 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("heyAutoDemoBundle:Templates:template_2_base.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "heyAutoDemoBundle:Templates:template_2_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_security.last_username"), "method"), "html", null, true);
        echo " ";
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo "\t<style>
\t\t.user-picture {
\t\t\twidth: 96px;
\t\t\theight: 96px;
\t\t\tborder-radius: 50%; /*the magic*/
\t\t\tfloat: left;
\t\t}
\t\t.taxi-picture {
\t\t\twidth: 150px;
\t\t\theight: 106px;
\t\t\tfloat: left;
\t\t}
\t\t.button-right {
\t\t\tfloat:right; 
\t\t\tmargin: 10px;
\t\t}
\t</style>
";
    }

    // line 31
    public function block_javascript($context, array $blocks = array())
    {
        // line 32
        echo "
<noscript>
<!--
    We have the \"refresh\" meta-tag in case the user's browser does
    not correctly support JavaScript or has JavaScript disabled.

    Notice that this is nested within a \"noscript\" block.
-->
<meta http-equiv=\"refresh\" content=\"2\">

</noscript>
\t
\t<script>


\t\t\$(document).ready(function() {

\t\t\t\$('.button-right').click(function() {
\t\t\t    \$.ajax({
\t\t\t        url: \"\",
\t\t\t        context: document.body,
\t\t\t        success: function(s,x){

\t\t\t            \$('html[manifest=saveappoffline.appcache]').attr('content', '');
\t\t\t                \$(this).html(s);
\t\t\t        }
\t\t\t    }); 
\t\t\t});
\t\t    
\t\t    \$(\"#uploadIconCar\").click(function(){
\t\t       \$(this).next().trigger('click');
\t\t    });

\t\t    \$(\"#uploadIconProfile\").bind(\"click\",function() {

\t\t         \$(\"#ProfileImgToUpload\").trigger('click');

\t\t    });

\t\t    
\t\t});
\t\tfunction readURLProfile(input) {
\t        if (input.files && input.files[0]) {
\t            var reader = new FileReader();

\t            reader.onload = function (e) {
\t                \$('#iconUser')
\t                    .attr('src', e.target.result)
\t                    .width(96)
\t                    .height(96);
\t            };

\t            reader.readAsDataURL(input.files[0]);
\t        }
\t    }

\t    function readURLCar(input) {
\t        if (input.files && input.files[0]) {
\t            var reader = new FileReader();

\t            reader.onload = function (e) {
\t                \$('#iconCar')
\t                    .attr('src', e.target.result)
\t                    .width(150)
\t                    .height(106);
\t            };

\t            reader.readAsDataURL(input.files[0]);
\t        }
\t        
\t    }

\t         
    </script>
";
    }

    // line 110
    public function block_body($context, array $blocks = array())
    {
        // line 111
        echo "
<section id=\"main\" class=\"container\">
<h2><b>";
        // line 113
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_security.last_username"), "method"), "html", null, true);
        echo " 's Profile</b></h2>

\t<form action=\"";
        // line 115
        echo $this->env->getExtension('routing')->getPath("account");
        echo "\" method=\"POST\" enctype=\"multipart/form-data\">
\t";
        // line 117
        echo "\t<div class=\"row\">
\t\t<div class=\"12u\">
\t\t\t<section class=\"box\">
\t\t\t\t<input id=\"ProfileImgToUpload\" name=\"ProfileImgToUpload\" type=\"file\" onchange=\"readURLProfile(this);\" style=\"visibility: hidden;\" />
\t\t     \t<!-- circle user image -->
\t\t\t\t\t<a href=\"javascript:void(0)\" id=\"uploadIconProfile\" href=\"\">
\t\t\t        \t<img id=\"iconUser\" src=\"../images/profile/";
        // line 123
        echo twig_escape_filter($this->env, (isset($context["userid"]) ? $context["userid"] : $this->getContext($context, "userid")), "html", null, true);
        echo ".jpg\" class=\"user-picture\" />
\t\t\t        </a>
\t\t\t  
\t\t\t    
\t\t     \t<div lass=\"row uniform 50%\">
\t\t     \t\t<!-- username -->
\t\t     \t\t<h3 class=\"6u 12u(3) form-center\">Personal Information</h3>
\t\t\t\t\t<!-- fullname -->
\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 132
        $context["fullnameplaceholder"] = $this->env->getExtension('translator')->trans("full name");
        // line 133
        echo "\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "fullName"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["fullnameplaceholder"]) ? $context["fullnameplaceholder"] : $this->getContext($context, "fullnameplaceholder")))));
        echo "
\t\t\t\t\t</div>
\t\t\t\t\t<!-- password -->
\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 137
        $context["passwordplaceholder"] = $this->env->getExtension('translator')->trans("password");
        // line 138
        echo "\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), "pass"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["passwordplaceholder"]) ? $context["passwordplaceholder"] : $this->getContext($context, "passwordplaceholder")))));
        echo "
\t\t\t\t\t</div>
\t\t\t\t\t<!-- repeat password -->
\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 142
        $context["repasswordplaceholder"] = $this->env->getExtension('translator')->trans("confirm password");
        // line 143
        echo "\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), "confirm"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["repasswordplaceholder"]) ? $context["repasswordplaceholder"] : $this->getContext($context, "repasswordplaceholder")))));
        echo "
\t\t\t\t\t</div>
\t\t\t\t\t<!-- email -->
\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 147
        $context["emailplaceholder"] = $this->env->getExtension('translator')->trans("email");
        // line 148
        echo "\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["emailplaceholder"]) ? $context["emailplaceholder"] : $this->getContext($context, "emailplaceholder")))));
        echo "
\t\t\t\t\t</div>
\t\t\t\t\t<!-- phone number -->
\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 152
        $context["phonenoplaceholder"] = $this->env->getExtension('translator')->trans("phone no");
        // line 153
        echo "\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "phoneNo"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["phonenoplaceholder"]) ? $context["phonenoplaceholder"] : $this->getContext($context, "phonenoplaceholder")))));
        echo "
\t\t\t\t\t</div>
\t\t\t\t\t<!-- sex -->
\t\t\t\t\t";
        // line 162
        echo "\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 163
        if (((isset($context["gender"]) ? $context["gender"] : $this->getContext($context, "gender")) == "1")) {
            // line 164
            echo "\t\t\t\t\t\t\t<input type=\"radio\" id=\"user_gender_male\" name=\"user_gender\" value=\"1\" checked>
\t\t\t\t\t\t\t<label for=\"user_gender_male\">Male</label>
\t\t\t\t\t\t\t<input type=\"radio\" id=\"user_gender_female\" name=\"user_gender\" value=\"2\" >
\t\t\t\t\t\t\t<label for=\"user_gender_female\">Female</label>
\t\t\t\t\t\t";
        } else {
            // line 169
            echo "\t\t\t\t\t\t\t<input type=\"radio\" id=\"user_gender_male\" name=\"user_gender\" value=\"1\" >
\t\t\t\t\t\t\t<label for=\"user_gender_male\">Male</label>
\t\t\t\t\t\t\t<input type=\"radio\" id=\"user_gender_female\" name=\"user_gender\" value=\"2\" checked>
\t\t\t\t\t\t\t<label for=\"user_gender_female\">Female</label>
\t\t\t\t\t\t";
        }
        // line 174
        echo "\t\t            </div>
\t\t\t\t\t<!-- birth year -->
\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t";
        // line 177
        $context["birthyearplaceholder"] = $this->env->getExtension('translator')->trans("birth year");
        // line 178
        echo "\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "birthYear"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["birthyearplaceholder"]) ? $context["birthyearplaceholder"] : $this->getContext($context, "birthyearplaceholder")))));
        echo "
\t\t\t\t\t</div>

\t\t\t\t</div>

\t\t\t</section>
\t\t</div>
\t</div>


\t<!-- macro draw each vehicle -->
\t";
        // line 212
        echo "
\t

    <!-- list all vehicles of user -->
  
\t";
        // line 217
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vehicles"));
        foreach ($context['_seq'] as $context["_key"] => $context["vehicle"]) {
            // line 218
            echo "    \t<div class=\"row\">
\t\t\t<div class=\"12u\">
\t\t\t\t<section class=\"box\">
\t\t\t\t\t<!-- circle taxi image -->
\t\t\t\t    \t<a href=\"javascript:void(0)\" id=\"uploadIconCar\" href=\"\">
\t\t\t\t       \t\t<img id=\"iconCar\" src=\"../images/car/";
            // line 223
            echo twig_escape_filter($this->env, (isset($context["userid"]) ? $context["userid"] : $this->getContext($context, "userid")), "html", null, true);
            echo ".jpg\" class=\"taxi-picture\" />
\t\t\t\t        </a>
\t\t\t\t    <input id=\"CarImgToUpload\" name=\"CarImgToUpload\" type='file' 
\t\t\t\t    \t   onchange=\"readURLCar(this);\" style=\"visibility : hidden;\" />

\t\t\t\t    <!-- info of each vehicle -->
\t\t    \t\t<div lass=\"row uniform 50%\"> 
\t\t     \t\t\t<h3 class=\"6u 12u(3) form-center\">Vehicle Information</h3>
\t\t    \t\t\t";
            // line 231
            echo $this->getAttribute($this, "prototype", array(0 => (isset($context["vehicle"]) ? $context["vehicle"] : $this->getContext($context, "vehicle"))), "method");
            echo " 
\t\t    \t\t</div>
\t    \t\t</section>
\t\t\t</div>
\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['vehicle'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 237
        echo "
    <!-- button save -->
    <div class=\"button-right\">
\t\t<div class=\"\">
\t\t\t<ul class=\"actions\">
\t\t\t\t<li>";
        // line 242
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "save"), 'row', array("attr" => array("class" => "button special button-size-1 form-center"), "label" => "Save"));
        echo "</li>
\t\t\t</ul>
\t\t</div>
\t</div>

\t  
\t";
        // line 249
        echo "\t</form>




</section>

";
    }

    // line 189
    public function getprototype($_vehicle = null)
    {
        $context = $this->env->mergeGlobals(array(
            "vehicle" => $_vehicle,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 190
            echo "        <div class=\"6u 12u(3) form-center\">
        \t";
            // line 191
            $context["makeplaceholder"] = $this->env->getExtension('translator')->trans("make");
            // line 192
            echo "        \t";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["vehicle"]) ? $context["vehicle"] : $this->getContext($context, "vehicle")), "make"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["makeplaceholder"]) ? $context["makeplaceholder"] : $this->getContext($context, "makeplaceholder")))));
            echo " 
        </div>
        <div class=\"6u 12u(3) form-center\">
        \t";
            // line 195
            $context["modelplaceholder"] = $this->env->getExtension('translator')->trans("model");
            // line 196
            echo "        \t";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["vehicle"]) ? $context["vehicle"] : $this->getContext($context, "vehicle")), "model"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["modelplaceholder"]) ? $context["modelplaceholder"] : $this->getContext($context, "modelplaceholder")))));
            echo " 
        </div>
        <div class=\"6u 12u(3) form-center\">
        \t";
            // line 199
            $context["colorplaceholder"] = $this->env->getExtension('translator')->trans("color");
            // line 200
            echo "        \t";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["vehicle"]) ? $context["vehicle"] : $this->getContext($context, "vehicle")), "color"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["colorplaceholder"]) ? $context["colorplaceholder"] : $this->getContext($context, "colorplaceholder")))));
            echo " 
        </div>
        <div class=\"6u 12u(3) form-center\">
        \t";
            // line 203
            $context["yearplaceholder"] = $this->env->getExtension('translator')->trans("year");
            // line 204
            echo "        \t";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["vehicle"]) ? $context["vehicle"] : $this->getContext($context, "vehicle")), "year"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["yearplaceholder"]) ? $context["yearplaceholder"] : $this->getContext($context, "yearplaceholder")))));
            echo " 
        </div>
        <div class=\"6u 12u(3) form-center\">
        \t";
            // line 207
            $context["registrationNoplaceholder"] = $this->env->getExtension('translator')->trans("registration no");
            // line 208
            echo "        \t";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["vehicle"]) ? $context["vehicle"] : $this->getContext($context, "vehicle")), "registrationNo"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["registrationNoplaceholder"]) ? $context["registrationNoplaceholder"] : $this->getContext($context, "registrationNoplaceholder")))));
            echo " 
        </div>
        ";
            // line 211
            echo " \t";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "heyAutoDemoBundle:Users:account.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  396 => 211,  390 => 208,  388 => 207,  381 => 204,  379 => 203,  372 => 200,  370 => 199,  363 => 196,  361 => 195,  354 => 192,  352 => 191,  349 => 190,  338 => 189,  327 => 249,  318 => 242,  311 => 237,  299 => 231,  288 => 223,  281 => 218,  277 => 217,  270 => 212,  255 => 178,  253 => 177,  248 => 174,  241 => 169,  234 => 164,  232 => 163,  229 => 162,  222 => 153,  220 => 152,  212 => 148,  210 => 147,  202 => 143,  200 => 142,  192 => 138,  190 => 137,  182 => 133,  180 => 132,  168 => 123,  160 => 117,  156 => 115,  151 => 113,  147 => 111,  144 => 110,  66 => 32,  63 => 31,  42 => 10,  39 => 9,  31 => 5,);
    }
}
