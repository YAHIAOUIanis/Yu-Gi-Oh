<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerA8MUeeQ\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerA8MUeeQ/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerA8MUeeQ.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerA8MUeeQ\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerA8MUeeQ\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'A8MUeeQ',
    'container.build_id' => '5a099445',
    'container.build_time' => 1552947060,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerA8MUeeQ');
