<?php

/* deckBuilder/deckBuilder.html.twig */
class __TwigTemplate_f2ce87f7d30eeaf9d15a1af5d3a69750cd5db7c89ed97d7881c5526b044ee07f extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "deckBuilder/deckBuilder.html.twig", 1);
        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "deckBuilder/deckBuilder.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "deckBuilder/deckBuilder.html.twig"));

        // line 3
        $this->env->getRuntime("Symfony\\Component\\Form\\FormRenderer")->setTheme((isset($context["formDeckBuilder"]) || array_key_exists("formDeckBuilder", $context) ? $context["formDeckBuilder"] : (function () { throw new Twig_Error_Runtime('Variable "formDeckBuilder" does not exist.', 3, $this->source); })()), [0 => "bootstrap_4_layout.html.twig"], true);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Deck Builder";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 8
        echo "    <div class = \"container\">
        <h1>Deck Builder</h1>
        ";
        // line 10
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["formDeckBuilder"]) || array_key_exists("formDeckBuilder", $context) ? $context["formDeckBuilder"] : (function () { throw new Twig_Error_Runtime('Variable "formDeckBuilder" does not exist.', 10, $this->source); })()), 'form_start');
        echo "
            ";
        // line 11
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["formDeckBuilder"]) || array_key_exists("formDeckBuilder", $context) ? $context["formDeckBuilder"] : (function () { throw new Twig_Error_Runtime('Variable "formDeckBuilder" does not exist.', 11, $this->source); })()), "deckName", []), 'row', ["attr" => ["placeholder" => "Enter the name of your new Deck"]]);
        echo "
            <button type=\"submit\" class=\"btn btn-success\">Add</button>
        ";
        // line 13
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["formDeckBuilder"]) || array_key_exists("formDeckBuilder", $context) ? $context["formDeckBuilder"] : (function () { throw new Twig_Error_Runtime('Variable "formDeckBuilder" does not exist.', 13, $this->source); })()), 'form_end');
        echo "
    </div>

    <div class = \"container\">
        <form action=\"#\" method=\"POST\">
            <h3>Select your deck</h3>
            <div class = \"form-group\">
                <select class=\"form-control\">
                    ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["decks"]) || array_key_exists("decks", $context) ? $context["decks"] : (function () { throw new Twig_Error_Runtime('Variable "decks" does not exist.', 21, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            // line 22
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["d"], "id", []), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["d"], "deckName", []), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "                </select>
            </div>
            <div class = \"form-group\">
                <button type=\"submit\" class=\"btn btn-success\">Show</button>
            </div>
        </form>
    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "deckBuilder/deckBuilder.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 24,  103 => 22,  99 => 21,  88 => 13,  83 => 11,  79 => 10,  75 => 8,  66 => 7,  48 => 5,  38 => 1,  36 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}

{% form_theme formDeckBuilder 'bootstrap_4_layout.html.twig' %}

{% block title %}Deck Builder{% endblock %}

{% block body %}
    <div class = \"container\">
        <h1>Deck Builder</h1>
        {{ form_start(formDeckBuilder) }}
            {{ form_row(formDeckBuilder.deckName, {'attr' : {'placeholder': \"Enter the name of your new Deck\"}}) }}
            <button type=\"submit\" class=\"btn btn-success\">Add</button>
        {{ form_end(formDeckBuilder) }}
    </div>

    <div class = \"container\">
        <form action=\"#\" method=\"POST\">
            <h3>Select your deck</h3>
            <div class = \"form-group\">
                <select class=\"form-control\">
                    {% for d in decks %}
                        <option value=\"{{ d.id }}\"> {{ d.deckName }}</option>
                    {% endfor %}
                </select>
            </div>
            <div class = \"form-group\">
                <button type=\"submit\" class=\"btn btn-success\">Show</button>
            </div>
        </form>
    </div>
{% endblock %}", "deckBuilder/deckBuilder.html.twig", "E:\\L3_MIAGE_S6\\tech_web_avancé\\Yu-Gi-Oh\\templates\\deckBuilder\\deckBuilder.html.twig");
    }
}
