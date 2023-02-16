<?php

namespace mywishlist\afficheurs;

class PageInformation extends Afficheur
{
    public function execute(): string
    {
        return
            '<h3 class="elementor-heading-title elementor-size-default">Une SCIC c\'est quoi ? </h3>'
            . '<div class="elementor-text-editor elementor-clearfix">'
            . '<p>Court-circuit Nancy a fait le choix de la forme juridique la plus appropriée à ses valeurs. De forme privée et d’utilité sociale, le statut <strong>Société Coopérative d’Intérêt Collectif</strong> s’inscrit dans le courant de l’économie sociale et solidaire qui place l’humain, et non le capital, au cœur du projet.</p>'
            . '<p>Ce statut nous permet de réunir dans notre sociétariat l’ensemble des acteurs et actrices impliqué(e)s dans la filière et impose un réinvestissement des bénéfices à hauteur d’au moins 60 % dans la coopérative.</p><p>Le choix de la forme de société coopérative d’intérêt collectif constitue une adhésion à des valeurs coopératives fondamentales :</p>'
            . '<ul><li>La prééminence de la personne humaine</li><li>La démocratie</li><li>La solidarité</li><li>Un sociétariat multiple ayant pour finalité l’intérêt collectif au-delà de l’intérêt personnel</li><li>L’intégration sociale, économique et culturelle dans un territoire déterminé.</li></ul>'
            . '</div>'
            . '<h2 class="elementor-heading-title elementor-size-default">Court-circuit Nancy est une Société Coopérative d\'Intérêt Collectif (SCIC) </h2>'
            . '<div class="elementor-text-editor elementor-clearfix">'
            . '<p>Toute personne physique ou morale souhaitant agir de manière concrète pour changer notre mode de consommation en soutenant les filières locales, bio et le zéro déchet peut <strong>devenir sociétaire.</strong></p>'
            . '<p>Court-circuit Nancy accueille des sociétaires de différents horizons : des professionnel·le·s producteurs et productrices, agriculteurs et agricultrices, artisan·e·s ou artistes ; des associations citoyennes de protection de l’environnement, de la résilience alimentaire ; des investisseur·se·s et acteurs ou actrices de l’Économie locale, sociale et solidaire ; des collectivités locales et des particuliers.</p>'
            . '</div>';
    }
}