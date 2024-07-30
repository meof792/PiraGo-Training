# Tìm hiểu Git

## Git command

- Clone project: git clone
- Add to commit: git add
- Commit: git commit
    - Xem lịch sử commit: git log
- Push: git push
- Update: git pull
- Reset : git reset
- Tách branch: git checkout -b
    - Merge branch: git merge
    - Xóa branch (chỉ khi đã được merge): git checkout -d
    - Xóa branch: git checkout -D
- Chuyển branch: git checkout 
- Diff check: git diff
- Status check: git status
- Lưu thay đổi vào local: git stash"

*git stash: https://blog.pirago.vn/git-stash-cho-nhung-nguoi-thich-su-hoan-hao/*

## Git Flow 

- main: nhánh chính được phát hành
    - hotfix: sửa lỗi khẩn cấp trong bản chính 
    (*"hotfix" sau khi hoàn thành merge vào "main" và "develop"*)
- develop: nhánh phát triển cho các tính năng sắp tới
    - feature: phát triển tính năng cụ thể 
    (*"feature" sau khi hoàn thành merge vào "develop"*)
    - release: sửa lỗi nhỏ và chuẩn bị phát hành d
    (*"release" sau khi hoàn thành merge vào "main" và "develop"*)

## Quy Trình làm việc

- Tách branch lúc phát triển tính năng mới:
    - git checkout develop
    - git checkout -b feature/x
    - git checkout develop
    - git merge feature/x
    - git branch -d feature/x
- Tương tự với release, hotfix