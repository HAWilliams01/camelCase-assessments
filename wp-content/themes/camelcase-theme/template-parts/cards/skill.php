<?php

/**
 * Skill Card Template
 *
 * @param array $skill_data The skill data passed from the parent block.
 */

// Get the skill data passed from the parent block
$skill = get_query_var('skill_data');
?>

<div class="px-[2.625rem] py-16 text-center">
    <div class="flex items-center justify-center mb-[2.625rem]">
        <img src="<?php echo esc_url($skill['skills_image']['sizes']['medium']); ?>" alt="<?php echo esc_attr($skill['skills_image']['alt']); ?>">
    </div>
    <div>
        <h3 class="mb-4"><?php echo $skill['skills_headline']; ?></h3>
        <p class="text-[1.0625rem]"><?php echo $skill['skills_description']; ?></p>
    </div>
</div>