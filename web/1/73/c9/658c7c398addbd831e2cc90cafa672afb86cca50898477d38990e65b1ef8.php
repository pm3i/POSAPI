<?php

/* heyAutoDemoBundle:Templates:template_2_base.html.twig */
class __TwigTemplate_73c9658c7c398addbd831e2cc90cafa672afb86cca50898477d38990e65b1ef8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<!--
  Alpha by HTML5 UP
  html5up.net | @n33co
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

  <head>
    <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"description\" content=\"heyauto hey-auto hey auto\" />
    <meta name=\"keywords\" content=\"heyauto hey-auto hey auto\" />
    ";
        // line 14
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "8249cb4_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_8249cb4_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/images/8249cb4_heyauto-logo_1.png");
            // line 15
            echo "            <link rel='shortcut icon' href='";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "' />
    ";
        } else {
            // asset "8249cb4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_8249cb4") : $this->env->getExtension('assets')->getAssetUrl("_controller/images/8249cb4.png");
            echo "            <link rel='shortcut icon' href='";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "' />
    ";
        }
        unset($context["asset_url"]);
        // line 17
        echo "    ";
        // line 18
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/template2/jquery.min.js"), "html", null, true);
        echo "\"             type=\"text/javascript\" ></script>
    <script src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/template2/jquery.dropotron.min.js"), "html", null, true);
        echo "\"   type=\"text/javascript\" ></script>
    <script src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/template2/jquery.scrollgress.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\" ></script>
    <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/template2/skel.min.js"), "html", null, true);
        echo "\"               type=\"text/javascript\" ></script>
    <script src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/template2/skel-layers.min.js"), "html", null, true);
        echo "\"        type=\"text/javascript\" ></script>
    <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/js/template2/init.js"), "html", null, true);
        echo "\"                   type=\"text/javascript\" ></script>
    ";
        // line 25
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/css/template2/skel.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
    <link href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/css/template2/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
    <link href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/heyautodemo/css/template2/style-wide.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
    ";
        // line 29
        echo "    ";
        // line 30
        echo "    ";
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 31
        echo "    ";
        // line 32
        echo "    ";
        $this->displayBlock('javascript', $context, $blocks);
        // line 33
        echo "  </head>

  <body>
    <!-- Header -->
    ";
        // line 37
        $this->env->loadTemplate("heyAutoDemoBundle:Templates:template_2_header.html.twig")->display($context);
        // line 38
        echo "

    <!-- Main Body -->
    ";
        // line 41
        $this->displayBlock('body', $context, $blocks);
        // line 42
        echo "      

    <!-- Footer -->
    ";
        // line 45
        $this->env->loadTemplate("heyAutoDemoBundle:Templates:template_2_footer.html.twig")->display($context);
        // line 46
        echo "
  </body>
</html>

";
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
    }

    // line 30
    public function block_stylesheets($context, array $blocks = array())
    {
        echo " ";
    }

    // line 32
    public function block_javascript($context, array $blocks = array())
    {
        echo " ";
    }

    // line 41
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "heyAutoDemoBundle:Templates:template_2_base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 32,  139 => 10,  131 => 46,  129 => 45,  124 => 42,  122 => 41,  117 => 38,  115 => 37,  109 => 33,  106 => 32,  104 => 31,  101 => 30,  99 => 29,  95 => 27,  91 => 26,  86 => 25,  82 => 23,  78 => 22,  74 => 21,  70 => 20,  61 => 18,  59 => 17,  45 => 15,  41 => 14,  34 => 10,  23 => 1,  396 => 211,  390 => 208,  388 => 207,  381 => 204,  379 => 203,  372 => 200,  370 => 199,  363 => 196,  361 => 195,  354 => 192,  352 => 191,  349 => 190,  338 => 189,  327 => 249,  318 => 242,  311 => 237,  299 => 231,  288 => 223,  281 => 218,  277 => 217,  270 => 212,  255 => 178,  253 => 177,  248 => 174,  241 => 169,  234 => 164,  232 => 163,  229 => 162,  222 => 153,  220 => 152,  212 => 148,  210 => 147,  202 => 143,  200 => 142,  192 => 138,  190 => 137,  182 => 133,  180 => 132,  168 => 123,  160 => 117,  156 => 41,  151 => 113,  147 => 111,  144 => 30,  66 => 19,  63 => 31,  42 => 10,  39 => 9,  31 => 5,);
    }
}
