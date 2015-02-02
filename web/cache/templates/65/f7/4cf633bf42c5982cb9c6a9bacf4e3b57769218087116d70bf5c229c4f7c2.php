<?php

/* heyAutoDemoBundle:Homepage:homepage.html.twig */
class __TwigTemplate_65f74cf633bf42c5982cb9c6a9bacf4e3b57769218087116d70bf5c229c4f7c2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("heyAutoDemoBundle:Templates:template_2_base.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
            'endheader' => array($this, 'block_endheader'),
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

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo " HOMEPAGE ";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "  <style>
    #map-canvas {
      height: 500px;
      width: 800px;
      margin: auto;
      padding: 0px
    }
  </style>
";
    }

    // line 23
    public function block_javascript($context, array $blocks = array())
    {
        // line 24
        echo "  <script src=\"https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places\"></script>
  <script>
     
    var map;
    var infowindow;
    
    var drivers = new Array();
    var i = 0;
    var myLatlng ;
    var mapOptions;
    
    ";
        // line 35
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["users"]) ? $context["users"] : $this->getContext($context, "users")));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 36
            echo "        var u = new Array();
        u[0] = ";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "getId", array(), "method"), "html", null, true);
            echo "
        u[1] = ";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "getCurrentLocLat", array(), "method"), "html", null, true);
            echo "
        u[2] = ";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "getCurrentLocLng", array(), "method"), "html", null, true);
            echo "
        u[3] = ";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "getPhoneNo", array(), "method"), "html", null, true);
            echo "
        drivers[i++] = u 
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "            

    function initialize() {
      map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 12,
        center: new google.maps.LatLng(drivers[3][1], drivers[3][2]),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      infowindow = new google.maps.InfoWindow();

      var marker, i;
      var pinIcon = new google.maps.MarkerImage(
          ";
        // line 56
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "4b86715_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4b86715_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/images/4b86715_ic_taxi_driver_1.png");
            // line 57
            echo "            '";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "'
          ";
        } else {
            // asset "4b86715"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4b86715") : $this->env->getExtension('assets')->getAssetUrl("_controller/images/4b86715.png");
            echo "            '";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "'
          ";
        }
        unset($context["asset_url"]);
        // line 58
        echo ",
          null, /* size is determined at runtime */
          null, /* origin is 0,0 */
          null, /* anchor is bottom center of the scaled image */
          new google.maps.Size(32, 32)
      );      
      for (i = 0; i < drivers.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(drivers[i][1], drivers[i][2]),
          map: map,
          icon: pinIcon
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(drivers[i][3]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }

    google.maps.event.addDomListener(window, 'load', initialize);

  </script>
";
    }

    // line 87
    public function block_endheader($context, array $blocks = array())
    {
        // line 88
        echo "  
";
    }

    // line 93
    public function block_body($context, array $blocks = array())
    {
        // line 94
        echo "  
  <section id=\"main\" class=\"container\">

    <div class=\"row\">
      <div class=\"12u\">
        <section class=\"box\">
          <div id=\"map-canvas\"></div>
        </section>
      </div>
    </div>

  </section>

";
    }

    public function getTemplateName()
    {
        return "heyAutoDemoBundle:Homepage:homepage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 94,  167 => 93,  162 => 88,  159 => 87,  130 => 58,  116 => 57,  112 => 56,  97 => 43,  88 => 40,  84 => 39,  80 => 38,  76 => 37,  73 => 36,  69 => 35,  56 => 24,  53 => 23,  41 => 11,  38 => 10,  32 => 6,);
    }
}
