<?php

/* heyAutoDemoBundle:Users:myrides.html.twig */
class __TwigTemplate_67a5f91b76a0f94f0a3068df082567040716c15c3e36e6d283b52095bc5864b8 extends Twig_Template
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
        echo " MY RIDES ";
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo "  <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/css/jquery.rating.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
  <style>
    .button-right {
      float:right; 
      margin: 10px;
    }
  </style>
";
    }

    // line 21
    public function block_javascript($context, array $blocks = array())
    {
        // line 22
        echo "  <script src='";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/jquery.js"), "html", null, true);
        echo "' type=\"text/javascript\"></script>
  <script src='";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/jquery.MetaData.js"), "html", null, true);
        echo "' type=\"text/javascript\"></script>
  <script src='";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/jquery.rating.js"), "html", null, true);
        echo "' type=\"text/javascript\"></script>
  <script src='";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/jquery-ui.min.js"), "html", null, true);
        echo "' type=\"text/javascript\"></script>
  <script>
    \$(document).ready(function() {

      \$(\"#myrides_offerer\").bind(\"click\",function() {

        if (this.checked) { 
          ";
        // line 32
        $context["offerer"] = 1;
        echo ";
        }
        else {
          ";
        // line 35
        $context["offerer"] = 0;
        echo ";
        }

        document.getElementById(\"frmRides\").submit();
      });

      \$(\"#myrides_offeree\").bind(\"click\",function() {

        if (this.checked) { 
          ";
        // line 44
        $context["offeree"] = 1;
        echo "; 
        } else { ";
        // line 45
        $context["offeree"] = 0;
        echo "; } 
      
        document.getElementById(\"frmRides\").submit();
      });

      \$('.auto-submit-star').rating( {
        callback: function(value, link) {
          document.getElementById(\"frmRides\").submit();
        }
      });

      

    });
  </script>
";
    }

    // line 65
    public function block_body($context, array $blocks = array())
    {
        // line 66
        echo "
<section id=\"main\" class=\"container\">

  <form id=\"frmRides\" action=\"";
        // line 69
        echo $this->env->getExtension('routing')->getPath("rides");
        echo "\" method=\"post\" class=\"\">

    ";
        // line 80
        echo "
    ";
        // line 106
        echo "    
    <div class=\"row\">
      <div class=\"12u\">
       
          <div class=\"row uniform 50%\">
            <div class=\"6u 12u(2)\" >
              ";
        // line 112
        if (((isset($context["offerer"]) ? $context["offerer"] : $this->getContext($context, "offerer")) == 1)) {
            // line 113
            echo "                <input type=\"checkbox\" id=\"myrides_offerer\" name=\"myrides_offerer\" checked>
              ";
        } else {
            // line 115
            echo "                <input type=\"checkbox\" id=\"myrides_offerer\" name=\"myrides_offerer\" >
              ";
        }
        // line 117
        echo "              <label for=\"myrides_offerer\">Driver</label>
            
              ";
        // line 119
        if (((isset($context["offeree"]) ? $context["offeree"] : $this->getContext($context, "offeree")) == 1)) {
            // line 120
            echo "                <input type=\"checkbox\" id=\"myrides_offeree\" name=\"myrides_offeree\" checked>
              ";
        } else {
            // line 122
            echo "                <input type=\"checkbox\" id=\"myrides_offeree\" name=\"myrides_offeree\" >
              ";
        }
        // line 124
        echo "              <label for=\"myrides_offeree\">Passenger</label>
            </div>

            <!-- <div class=\"button-right\">
              <div class=\"\">
                <ul class=\"actions\">
                  <input type=\"submit\" disabled=\"true\" id=\"myrides_chose_role\" name=\"myrides_chose_role\" value=\"Submit\" class= \"button special button-size-1 form-center \" />
                </ul>
              </div>
            </div> -->
          </div> 
        
      </div>
    </div>
    </br>

    <!-- offerer table -->
    ";
        // line 141
        if (((isset($context["offerer"]) ? $context["offerer"] : $this->getContext($context, "offerer")) == 1)) {
            // line 142
            echo "    <div class=\"row\">
      <div class=\"12u\">
        <section class=\"box\">
          <div class=\"table-wrapper\">

            <label><h3>Driver</h3></label>
            <table>
              <thead>
                <tr align=\"center\">
                  <th>Date</th> <th>Distance</th> <th>Pickup</th> <th>Destination</th> <th>Rating</th>
                </tr>
              </thead>
              <tbody>
                ";
            // line 155
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), 0, array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 156
                echo "                <tr>
                  <td style=\"width:15%;\">";
                // line 157
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 1, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:10%;\">";
                // line 158
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 2, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:30%;\">";
                // line 159
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 3, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:30%;\">";
                // line 160
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 4, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:15%;\">
                    ";
                // line 162
                echo $this->getAttribute($this, "showRating", array(0 => $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 5, array(), "array"), 1 => $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 0, array(), "array")), "method");
                echo "
                  </td>
                </tr>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 166
            echo "              </tbody>

            </table>

          </div>
        </section>
      </div>
    </div>
    ";
        }
        // line 175
        echo "

    <!-- offeree table -->
    ";
        // line 178
        if (((isset($context["offeree"]) ? $context["offeree"] : $this->getContext($context, "offeree")) == 1)) {
            // line 179
            echo "    <div class=\"row\">
      <div class=\"12u\">
        <section class=\"box\">
          <div class=\"table-wrapper\">

            <label><h3>Passenger</h3></label>
            <table>
              <thead align=\"center\">
                <tr >
                  <th>Date</th> <th>Distance</th> <th>Pickup</th> <th>Destination</th> <th>Rating</th>
                </tr>
              </thead>
              <tbody>
                ";
            // line 192
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), 1, array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 193
                echo "                <tr>
                  <td style=\"width:15%;\">";
                // line 194
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 1, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:10%;\">";
                // line 195
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 2, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:30%;\">";
                // line 196
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 3, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:30%;\">";
                // line 197
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 4, array(), "array"), "html", null, true);
                echo "</td>
                  <td style=\"width:15%;\">
                    ";
                // line 199
                echo $this->getAttribute($this, "showRating", array(0 => $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 5, array(), "array"), 1 => $this->getAttribute((isset($context["item"]) ? $context["item"] : $this->getContext($context, "item")), 0, array(), "array")), "method");
                echo "
                  </td>
                </tr>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 203
            echo "              </tbody>

            </table>

          </div>
        </section>
      </div>
    </div>
    ";
        }
        // line 212
        echo "

    <!-- button save rating values -->
    <td colspan=\"5\"><input type=\"hidden\" id=\"myrides_save\" name=\"myrides_save\" value=\"Save\" class= \"button button-size-1 form-center button-right\" /></td>
  

  </form>
</section>

";
    }

    // line 71
    public function getdrawRating($_name = null, $_checked1 = null, $_checked2 = null, $_checked3 = null, $_checked4 = null, $_checked5 = null)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $_name,
            "checked1" => $_checked1,
            "checked2" => $_checked2,
            "checked3" => $_checked3,
            "checked4" => $_checked4,
            "checked5" => $_checked5,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 72
            echo "      <div class=\"Clear\">
        <input class=\"auto-submit-star\" type=\"radio\" name=\"";
            // line 73
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "\" value=\"1\" ";
            echo twig_escape_filter($this->env, (isset($context["checked1"]) ? $context["checked1"] : $this->getContext($context, "checked1")), "html", null, true);
            echo " />
        <input class=\"auto-submit-star\" type=\"radio\" name=\"";
            // line 74
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "\" value=\"2\" ";
            echo twig_escape_filter($this->env, (isset($context["checked2"]) ? $context["checked2"] : $this->getContext($context, "checked2")), "html", null, true);
            echo "/>
        <input class=\"auto-submit-star\" type=\"radio\" name=\"";
            // line 75
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "\" value=\"3\" ";
            echo twig_escape_filter($this->env, (isset($context["checked3"]) ? $context["checked3"] : $this->getContext($context, "checked3")), "html", null, true);
            echo "/>
        <input class=\"auto-submit-star\" type=\"radio\" name=\"";
            // line 76
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "\" value=\"4\" ";
            echo twig_escape_filter($this->env, (isset($context["checked4"]) ? $context["checked4"] : $this->getContext($context, "checked4")), "html", null, true);
            echo "/>
        <input class=\"auto-submit-star\" type=\"radio\" name=\"";
            // line 77
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "\" value=\"5\" ";
            echo twig_escape_filter($this->env, (isset($context["checked5"]) ? $context["checked5"] : $this->getContext($context, "checked5")), "html", null, true);
            echo "/>
      </div>
    ";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 81
    public function getshowRating($_rating = null, $_name = null)
    {
        $context = $this->env->mergeGlobals(array(
            "rating" => $_rating,
            "name" => $_name,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 82
            echo "        ";
            if (((isset($context["rating"]) ? $context["rating"] : $this->getContext($context, "rating")) == twig_escape_filter($this->env, 0))) {
                // line 83
                echo "          ";
                echo $this->getAttribute($this, "drawRating", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => "", 2 => "", 3 => "", 4 => "", 5 => ""), "method");
                echo "
        ";
            }
            // line 85
            echo "
        ";
            // line 86
            if (((isset($context["rating"]) ? $context["rating"] : $this->getContext($context, "rating")) == 1)) {
                // line 87
                echo "          ";
                echo $this->getAttribute($this, "drawRating", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => "checked", 2 => "", 3 => "", 4 => "", 5 => ""), "method");
                echo "
        ";
            }
            // line 89
            echo "
        ";
            // line 90
            if (((isset($context["rating"]) ? $context["rating"] : $this->getContext($context, "rating")) == 2)) {
                // line 91
                echo "          ";
                echo $this->getAttribute($this, "drawRating", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => "", 2 => "checked", 3 => "", 4 => "", 5 => ""), "method");
                echo "
        ";
            }
            // line 93
            echo "
        ";
            // line 94
            if (((isset($context["rating"]) ? $context["rating"] : $this->getContext($context, "rating")) == 3)) {
                // line 95
                echo "          ";
                echo $this->getAttribute($this, "drawRating", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => "", 2 => "", 3 => "checked", 4 => "", 5 => ""), "method");
                echo "
        ";
            }
            // line 97
            echo "
        ";
            // line 98
            if (((isset($context["rating"]) ? $context["rating"] : $this->getContext($context, "rating")) == 4)) {
                // line 99
                echo "          ";
                echo $this->getAttribute($this, "drawRating", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => "", 2 => "", 3 => "", 4 => "checked", 5 => ""), "method");
                echo "
        ";
            }
            // line 101
            echo "
        ";
            // line 102
            if (((isset($context["rating"]) ? $context["rating"] : $this->getContext($context, "rating")) == 5)) {
                // line 103
                echo "          ";
                echo $this->getAttribute($this, "drawRating", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => "", 2 => "", 3 => "", 4 => "", 5 => "checked"), "method");
                echo "
        ";
            }
            // line 105
            echo "    ";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "heyAutoDemoBundle:Users:myrides.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  465 => 105,  459 => 103,  457 => 102,  454 => 101,  448 => 99,  446 => 98,  443 => 97,  437 => 95,  435 => 94,  432 => 93,  426 => 91,  424 => 90,  421 => 89,  415 => 87,  413 => 86,  410 => 85,  404 => 83,  401 => 82,  389 => 81,  373 => 77,  367 => 76,  361 => 75,  355 => 74,  349 => 73,  346 => 72,  330 => 71,  317 => 212,  306 => 203,  296 => 199,  291 => 197,  287 => 196,  283 => 195,  279 => 194,  276 => 193,  272 => 192,  257 => 179,  255 => 178,  250 => 175,  239 => 166,  229 => 162,  224 => 160,  220 => 159,  216 => 158,  212 => 157,  209 => 156,  205 => 155,  190 => 142,  188 => 141,  169 => 124,  165 => 122,  161 => 120,  159 => 119,  155 => 117,  151 => 115,  147 => 113,  145 => 112,  137 => 106,  134 => 80,  129 => 69,  124 => 66,  121 => 65,  101 => 45,  97 => 44,  85 => 35,  79 => 32,  69 => 25,  65 => 24,  61 => 23,  56 => 22,  53 => 21,  40 => 10,  37 => 9,  31 => 5,);
    }
}
