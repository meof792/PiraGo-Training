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
    - release: sửa lỗi nhỏ và chuẩn bị phát hành 
    (*"release" sau khi hoàn thành merge vào "main" và "develop"*)