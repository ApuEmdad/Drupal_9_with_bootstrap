<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/bootstrap4/templates/navigation/menu--main.html.twig */
class __TwigTemplate_4880bafc0a600c7f48526f35127ba61f extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        $macros["menus"] = $this->macros["menus"] = $this;
        // line 22
        echo "
";
        // line 27
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["menus"], "macro_build_menu", [($context["items"] ?? null), ($context["attributes"] ?? null), 0], 27, $context, $this->getSourceContext()));
        echo "

";
        // line 43
        echo "
";
    }

    // line 29
    public function macro_build_menu($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 30
            echo "  ";
            $macros["menus"] = $this;
            // line 31
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 32
                echo "    ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 33
                    echo "    <ul";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "navbar-nav mr-auto"], "method", false, false, true, 33), 33, $this->source), "html", null, true);
                    echo ">
    ";
                } else {
                    // line 35
                    echo "    <ul class=\"dropdown-menu\">
    ";
                }
                // line 37
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 38
                    echo "      ";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["menus"], "macro_add_link", [$context["item"], ($context["attributes"] ?? null), ($context["menu_level"] ?? null)], 38, $context, $this->getSourceContext()));
                    echo "
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 40
                echo "    </ul>
  ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 44
    public function macro_add_link($__item__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 45
            echo "  ";
            $macros["menus"] = $this;
            // line 46
            echo "  ";
            // line 47
            $context["list_item_classes"] = [0 => "nav-item", 1 => ((twig_get_attribute($this->env, $this->source,             // line 49
($context["item"] ?? null), "is_expanded", [], "any", false, false, true, 49)) ? ("dropdown") : (""))];
            // line 52
            echo "  ";
            // line 53
            $context["link_classes"] = [0 => (((            // line 54
($context["menu_level"] ?? null) == 0)) ? ("nav-link") : ("dropdown-item")), 1 => ((twig_get_attribute($this->env, $this->source,             // line 55
($context["item"] ?? null), "in_active_trail", [], "any", false, false, true, 55)) ? ("active") : ("")), 2 => ((((            // line 56
($context["menu_level"] ?? null) == 0) && (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "is_expanded", [], "any", false, false, true, 56) || twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "is_collapsed", [], "any", false, false, true, 56)))) ? ("dropdown-toggle") : (""))];
            // line 59
            echo "  <li";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "attributes", [], "any", false, false, true, 59), "addClass", [0 => ($context["list_item_classes"] ?? null)], "method", false, false, true, 59), 59, $this->source), "html", null, true);
            echo ">
  ";
            // line 60
            $context["link_attrs"] = ["class" => ($context["link_classes"] ?? null)];
            // line 61
            echo "  ";
            if (((($context["menu_level"] ?? null) == 0) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "below", [], "any", false, false, true, 61))) {
                // line 62
                echo "    ";
                $context["link_attrs"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["link_attrs"] ?? null), 62, $this->source), ["data-toggle" => "dropdown", "title" => ((t("Expand menu") . " ") . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, true, 62), 62, $this->source)), "aria-haspopup" => "true", "aria-expanded" => "false"]);
                // line 63
                echo "  ";
            }
            // line 64
            echo "  ";
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "in_active_trail", [], "any", false, false, true, 64)) {
                // line 65
                echo "    ";
                $context["link_attrs"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["link_attrs"] ?? null), 65, $this->source), ["aria-current" => "page"]);
                // line 66
                echo "  ";
            }
            // line 67
            echo "
  ";
            // line 68
            if (((($context["menu_level"] ?? null) == 0) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "below", [], "any", false, false, true, 68))) {
                // line 69
                echo "    ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, true, 69), 69, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "url", [], "any", false, false, true, 69), 69, $this->source), $this->sandbox->ensureToStringAllowed(($context["link_attrs"] ?? null), 69, $this->source)), "html", null, true);
                echo "
    ";
                // line 70
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["menus"], "macro_build_menu", [twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "below", [], "any", false, false, true, 70), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)], 70, $context, $this->getSourceContext()));
                echo "
  ";
            } else {
                // line 72
                echo "    ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, true, 72), 72, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "url", [], "any", false, false, true, 72), 72, $this->source), $this->sandbox->ensureToStringAllowed(($context["link_attrs"] ?? null), 72, $this->source)), "html", null, true);
                echo "
  ";
            }
            // line 74
            echo "  </li>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap4/templates/navigation/menu--main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 74,  183 => 72,  178 => 70,  173 => 69,  171 => 68,  168 => 67,  165 => 66,  162 => 65,  159 => 64,  156 => 63,  153 => 62,  150 => 61,  148 => 60,  143 => 59,  141 => 56,  140 => 55,  139 => 54,  138 => 53,  136 => 52,  134 => 49,  133 => 47,  131 => 46,  128 => 45,  113 => 44,  102 => 40,  93 => 38,  88 => 37,  84 => 35,  78 => 33,  75 => 32,  72 => 31,  69 => 30,  54 => 29,  49 => 43,  44 => 27,  41 => 22,  39 => 21,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/bootstrap4/templates/navigation/menu--main.html.twig", "C:\\Apu\\code\\Laravel\\drupal\\drupal-9.5.3\\themes\\contrib\\bootstrap4\\templates\\navigation\\menu--main.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("import" => 21, "macro" => 29, "if" => 31, "for" => 37, "set" => 47);
        static $filters = array("escape" => 33, "merge" => 62, "t" => 62);
        static $functions = array("link" => 69);

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape', 'merge', 't'],
                ['link']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
