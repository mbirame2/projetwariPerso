<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerBxdkhWg\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerBxdkhWg/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerBxdkhWg.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerBxdkhWg\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerBxdkhWg\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'BxdkhWg',
    'container.build_id' => '7d6aafc7',
    'container.build_time' => 1565955818,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerBxdkhWg');
