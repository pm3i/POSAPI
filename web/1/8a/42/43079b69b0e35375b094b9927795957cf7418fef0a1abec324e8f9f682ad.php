<?php

/* heyAutoDemoBundle:Users:signin.html.twig */
class __TwigTemplate_8a4243079b69b0e35375b094b9927795957cf7418fef0a1abec324e8f9f682ad extends Twig_Template
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

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo " SIGN IN ";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "\t<style>
\t\t.button-right {
\t\t\tfloat:right; 
\t\t\tmargin: -10px auto;
\t\t}
\t</style>
";
    }

    // line 21
    public function block_javascript($context, array $blocks = array())
    {
    }

    // line 26
    public function block_body($context, array $blocks = array())
    {
        // line 27
        echo "<section id=\"main\" class=\"container\">


";
        // line 30
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start', array("atrr" => array("novalidate" => "novalidate")));
        echo "
\t<div class=\"row\">
\t\t<div class=\"12u\">
\t\t\t<section class=\"box\">

\t\t\t\t\t<div lass=\"row uniform 50%\">
\t\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t\t";
        // line 37
        $context["usernameplaceholder"] = $this->env->getExtension('translator')->trans("user name");
        // line 38
        echo "\t\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["usernameplaceholder"]) ? $context["usernameplaceholder"] : $this->getContext($context, "usernameplaceholder")))));
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"6u 12u(3) form-center\">
\t\t\t\t\t\t\t";
        // line 41
        $context["passwordplaceholder"] = $this->env->getExtension('translator')->trans("password");
        // line 42
        echo "\t\t\t\t\t\t\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), 'widget', array("attr" => array("class" => "class-css-here", "placeholder" => (isset($context["passwordplaceholder"]) ? $context["passwordplaceholder"] : $this->getContext($context, "passwordplaceholder")))));
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"button-right\">
\t\t\t\t\t\t<div class=\"\">
\t\t\t\t\t\t\t<ul class=\"actions\">
\t\t\t\t\t\t\t\t<li>";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "login"), 'row', array("attr" => array("class" => "button special button-size-1 form-center"), "label" => "Login"));
        echo "</li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t</section>
\t\t</div>
\t</div>
";
        // line 57
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "


</section>
";
    }

    public function getTemplateName()
    {
        return "heyAutoDemoBundle:Users:signin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 57,  95 => 49,  84 => 42,  82 => 41,  75 => 38,  73 => 37,  63 => 30,  58 => 27,  55 => 26,  50 => 21,  40 => 11,  37 => 10,  31 => 6,);
    }
}
