<?php

/* heyAutoDemoBundle:Templates:template_2_header.html.twig */
class __TwigTemplate_bc86788c1995f769eaddfa486559cd52a5fd7abfbc270b21b3c3fe07df8936aa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<header id=\"header\" class=\"skel-layers-fixed\">
  <h1><a href=\"";
        // line 2
        echo $this->env->getExtension('routing')->getPath("home");
        echo "\">HEY</a> AUTO </h1>
  <nav id=\"nav\">
    <ul>
      <li><a href=\"";
        // line 5
        echo $this->env->getExtension('routing')->getPath("home");
        echo "\">Home</a></li>
      <li>
        <a href=\"\" class=\"icon fa-angle-down\">Menu</a>
        <ul>
          <li><a href=\"";
        // line 9
        echo $this->env->getExtension('routing')->getPath("account");
        echo "\">Account Info</a></li>
          <li><a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("rides");
        echo "\">Rides</a></li>
          <li>
            <a href=\"\">Submenu</a>
            <ul>
              <li><a href=\"#\">Option One</a></li>
              <li><a href=\"#\">Option Two</a></li>
              <li><a href=\"#\">Option Three</a></li>
              <li><a href=\"#\">Option Four</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li> 
        ";
        // line 23
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_security.last_username"), "method") != null)) {
            // line 24
            echo "          <a href=\"";
            echo $this->env->getExtension('routing')->getPath("account");
            echo "\" class=\"set-some-style-here\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_security.last_username"), "method"), "html", null, true);
            echo "</a>
          <a href=\"";
            // line 25
            echo $this->env->getExtension('routing')->getPath("signout");
            echo "\" class=\"button\">Sign out</a>
        ";
        } else {
            // line 27
            echo "          <a href=\"";
            echo $this->env->getExtension('routing')->getPath("signin");
            echo "\" class=\"button\">Sign in</a>
        ";
        }
        // line 29
        echo "      </li>
      ";
        // line 31
        echo "    </ul>
  </nav>
</header>";
    }

    public function getTemplateName()
    {
        return "heyAutoDemoBundle:Templates:template_2_header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 29,  69 => 27,  64 => 25,  57 => 24,  55 => 23,  35 => 9,  28 => 5,  22 => 2,  19 => 1,  150 => 32,  139 => 10,  131 => 46,  129 => 45,  124 => 42,  122 => 41,  117 => 38,  115 => 37,  109 => 33,  106 => 32,  104 => 31,  101 => 30,  99 => 29,  95 => 27,  91 => 26,  86 => 25,  82 => 23,  78 => 31,  74 => 21,  70 => 20,  61 => 18,  59 => 17,  45 => 15,  41 => 14,  34 => 10,  23 => 1,  396 => 211,  390 => 208,  388 => 207,  381 => 204,  379 => 203,  372 => 200,  370 => 199,  363 => 196,  361 => 195,  354 => 192,  352 => 191,  349 => 190,  338 => 189,  327 => 249,  318 => 242,  311 => 237,  299 => 231,  288 => 223,  281 => 218,  277 => 217,  270 => 212,  255 => 178,  253 => 177,  248 => 174,  241 => 169,  234 => 164,  232 => 163,  229 => 162,  222 => 153,  220 => 152,  212 => 148,  210 => 147,  202 => 143,  200 => 142,  192 => 138,  190 => 137,  182 => 133,  180 => 132,  168 => 123,  160 => 117,  156 => 41,  151 => 113,  147 => 111,  144 => 30,  66 => 19,  63 => 31,  42 => 10,  39 => 10,  31 => 5,);
    }
}
