<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerH9DxMAt\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerH9DxMAt/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerH9DxMAt.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerH9DxMAt\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerH9DxMAt\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'H9DxMAt',
    'container.build_id' => '5174674d',
    'container.build_time' => 1564081839,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerH9DxMAt');
